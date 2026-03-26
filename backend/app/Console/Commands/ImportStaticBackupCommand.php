<?php

namespace App\Console\Commands;

use App\Models\ContentPage;
use App\Models\ContentPageRoute;
use App\Models\ContentSection;
use App\Models\SiteFile;
use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class ImportStaticBackupCommand extends Command
{
    protected $signature = 'content:import-static
        {--source=../static_backup : Source directory containing html files}
        {--fresh : Clear imported content tables before importing}';

    protected $description = 'Import static backup html files into normalized content tables';

    public function handle(): int
    {
        $source = base_path($this->option('source'));

        if (! is_dir($source)) {
            $this->error("Source directory not found: {$source}");

            return self::FAILURE;
        }

        if ($this->option('fresh')) {
            $this->clearImportedData();
        }

        $importedPages = 0;
        $routeWrites = 0;
        $sectionCache = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (! $file->isFile()) {
                continue;
            }

            $ext = strtolower($file->getExtension());
            if (! in_array($ext, ['html', 'htm'], true)) {
                continue;
            }

            $absolutePath = $file->getPathname();
            $relativePath = ltrim(str_replace('\\', '/', Str::after($absolutePath, $source)), '/');
            $relativePath = $this->normalizeRelativePath($relativePath);

            if ($relativePath === '') {
                continue;
            }

            $html = file_get_contents($absolutePath);
            if ($html === false) {
                $this->warn("Skip unreadable file: {$absolutePath}");
                continue;
            }

            $meta = $this->extractMeta($html);

            $section = $this->resolveSection($relativePath, $sectionCache);
            $primaryPath = $this->toPublicPath($relativePath);
            $aliases = $this->buildRouteAliases($primaryPath);

            $page = ContentPage::query()->updateOrCreate(
                ['source_path' => $relativePath],
                [
                    'content_section_id' => $section?->id,
                    'title' => $meta['title'],
                    'meta_description' => $meta['description'],
                    'meta_keywords' => $meta['keywords'],
                    'canonical_url' => $meta['canonical'],
                    'is_homepage' => in_array('/', $aliases, true),
                    'html' => $html,
                ]
            );

            ContentPageRoute::query()->where('content_page_id', $page->id)->delete();

            foreach ($aliases as $index => $path) {
                ContentPageRoute::query()->updateOrCreate(
                    ['path' => $path],
                    [
                        'content_page_id' => $page->id,
                        'is_primary' => $index === 0,
                    ]
                );
                $routeWrites++;
            }

            $importedPages++;
        }

        $this->importRobotsFile($source);

        $this->info("Imported pages: {$importedPages}");
        $this->info("Written routes: {$routeWrites}");
        $this->info('Imported robots.txt into site_files');

        return self::SUCCESS;
    }

    private function clearImportedData(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF');
        ContentPageRoute::query()->truncate();
        ContentPage::query()->truncate();
        ContentSection::query()->truncate();
        SiteFile::query()->truncate();
        DB::statement('PRAGMA foreign_keys = ON');
    }

    private function normalizeRelativePath(string $relativePath): string
    {
        $segments = array_filter(
            explode('/', $relativePath),
            static fn (string $segment): bool => $segment !== ''
        );

        $segments = array_map(function (string $segment): string {
            $segment = str_replace("\xc2\xa0", ' ', $segment);
            return trim($segment);
        }, $segments);

        return implode('/', $segments);
    }

    private function resolveSection(string $relativePath, array &$cache): ?ContentSection
    {
        $segments = explode('/', $relativePath);
        $first = $segments[0] ?? null;

        if ($first === null || $first === '' || $first === 'index.html') {
            return null;
        }

        $sectionSlug = Str::slug($first);
        if ($sectionSlug === '') {
            return null;
        }

        if (isset($cache[$sectionSlug])) {
            return $cache[$sectionSlug];
        }

        $section = ContentSection::query()->firstOrCreate(
            ['slug' => $sectionSlug],
            [
                'name' => Str::of($first)->replace('-', ' ')->title()->toString(),
                'kind' => $this->detectSectionKind($sectionSlug),
            ]
        );

        $cache[$sectionSlug] = $section;

        return $section;
    }

    private function detectSectionKind(string $sectionSlug): string
    {
        if (Str::contains($sectionSlug, 'news')) {
            return 'news';
        }

        if (in_array($sectionSlug, ['cart', 'products', 'casecenter', 'honor'], true)) {
            return 'utility';
        }

        return 'catalog';
    }

    private function toPublicPath(string $relativePath): string
    {
        return '/'.ltrim($relativePath, '/');
    }

    private function buildRouteAliases(string $primaryPath): array
    {
        $aliases = [$this->normalizePublicPath($primaryPath)];

        if (str_ends_with($primaryPath, '/index.html')) {
            $aliases[] = $this->normalizePublicPath(Str::beforeLast($primaryPath, '/index.html'));
        }

        if ($primaryPath === '/index.html') {
            $aliases[] = '/';
        }

        if (str_ends_with($primaryPath, '.html')) {
            $aliases[] = $this->normalizePublicPath(Str::beforeLast($primaryPath, '.html'));
        }

        return array_values(array_unique(array_filter($aliases)));
    }

    private function normalizePublicPath(string $path): string
    {
        $clean = '/'.trim($path, '/');
        $clean = preg_replace('#/+#', '/', $clean) ?? $clean;

        return $clean === '/' ? '/' : rtrim($clean, '/');
    }

    private function extractMeta(string $html): array
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html, LIBXML_NOWARNING | LIBXML_NOERROR | LIBXML_NONET);
        $xpath = new DOMXPath($dom);

        $title = trim((string) $xpath->evaluate('string(//title)'));
        $description = trim((string) $xpath->evaluate("string(//meta[@name='description']/@content)"));
        $keywords = trim((string) $xpath->evaluate("string(//meta[@name='keywords']/@content)"));
        $canonical = trim((string) $xpath->evaluate("string(//link[@rel='canonical']/@href)"));

        return [
            'title' => $title !== '' ? $title : null,
            'description' => $description !== '' ? $description : null,
            'keywords' => $keywords !== '' ? $keywords : null,
            'canonical' => $canonical !== '' ? $canonical : null,
        ];
    }

    private function importRobotsFile(string $source): void
    {
        $robotsPath = "{$source}/robots.txt";
        if (! is_file($robotsPath)) {
            return;
        }

        $content = file_get_contents($robotsPath);
        if ($content === false) {
            $this->warn("Skip unreadable robots file: {$robotsPath}");
            return;
        }

        SiteFile::query()->updateOrCreate(
            ['path' => '/robots.txt'],
            [
                'mime_type' => 'text/plain',
                'content' => $content,
            ]
        );
    }
}
