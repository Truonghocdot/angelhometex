<?php

namespace App\Http\Controllers;

use App\Models\ContentPageRoute;
use App\Models\SiteFile;
use DOMDocument;
use DOMElement;
use Illuminate\Http\Response;

class StaticContentController extends Controller
{
    public function show(?string $path = null): Response
    {
        $requestPath = $this->normalizePath($path);
        $rawHtml = $this->resolveRawHtml($requestPath);
        if ($rawHtml === null) {
            abort(404);
        }

        $page = $this->transformToLayoutData($rawHtml);

        return response()
            ->view('content.page', $page)
            ->header('Content-Type', 'text/html; charset=UTF-8');
    }

    public function robots(): Response
    {
        $robots = SiteFile::query()->where('path', '/robots.txt')->first();

        if (! $robots) {
            abort(404);
        }

        return response($robots->content)
            ->header('Content-Type', $robots->mime_type.'; charset=UTF-8');
    }

    private function normalizePath(?string $path): string
    {
        $normalized = '/'.trim((string) $path, '/');

        return $normalized === '/' ? '/' : rtrim($normalized, '/');
    }

    private function resolveView(string $requestPath): ?string
    {
        $path = ltrim($requestPath, '/');
        $candidates = [];

        if ($path === '') {
            $candidates[] = 'index';
        } else {
            if (str_ends_with($path, '/index.html')) {
                $segment = substr($path, 0, -11);
                if ($segment !== '') {
                    $candidates[] = str_replace('/', '.', $segment).'.index';
                    $candidates[] = str_replace('/', '.', $segment);
                }
            }

            if (str_ends_with($path, '.html')) {
                $segment = substr($path, 0, -5);
                if ($segment !== '') {
                    $candidates[] = str_replace('/', '.', $segment);
                }
            } else {
                $candidates[] = str_replace('/', '.', $path);
                $candidates[] = str_replace('/', '.', $path).'.index';
            }
        }

        $candidates = array_values(array_unique(array_filter($candidates)));

        foreach ($candidates as $candidate) {
            if (view()->exists($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    private function resolveRawHtml(string $requestPath): ?string
    {
        $route = ContentPageRoute::query()
            ->with('page')
            ->where('path', $requestPath)
            ->first();

        if ($route?->page?->html) {
            return $route->page->html;
        }

        $view = $this->resolveView($requestPath);
        if ($view !== null) {
            return view($view)->render();
        }

        return null;
    }

    private function transformToLayoutData(string $rawHtml): array
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($rawHtml, LIBXML_NOWARNING | LIBXML_NOERROR | LIBXML_NONET);

        $html = $dom->getElementsByTagName('html')->item(0);
        $head = $dom->getElementsByTagName('head')->item(0);
        $body = $dom->getElementsByTagName('body')->item(0);

        $headHtml = $head ? $this->innerHtml($head, $dom) : '';
        $bodyHtml = $body ? $this->innerHtml($body, $dom) : $rawHtml;

        return [
            'htmlAttributes' => $html instanceof DOMElement ? $this->attributesToString($html) : '',
            'bodyAttributes' => $body instanceof DOMElement ? $this->attributesToString($body) : '',
            'headHtml' => $headHtml,
            'bodyHtml' => $bodyHtml,
        ];
    }

    private function innerHtml(DOMElement $element, DOMDocument $dom): string
    {
        $html = '';
        foreach ($element->childNodes as $child) {
            $html .= $dom->saveHTML($child);
        }

        return $html;
    }

    private function attributesToString(DOMElement $element): string
    {
        $parts = [];
        foreach ($element->attributes as $attribute) {
            $parts[] = sprintf('%s="%s"', $attribute->name, e($attribute->value));
        }

        return implode(' ', $parts);
    }
}
