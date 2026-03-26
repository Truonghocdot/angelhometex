<x-filament-panels::page>
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        <x-filament::section>
            <div class="text-sm text-gray-500">Sections</div>
            <div class="text-2xl font-semibold">{{ number_format($sectionsCount) }}</div>
        </x-filament::section>

        <x-filament::section>
            <div class="text-sm text-gray-500">Pages</div>
            <div class="text-2xl font-semibold">{{ number_format($pagesCount) }}</div>
        </x-filament::section>

        <x-filament::section>
            <div class="text-sm text-gray-500">Routes</div>
            <div class="text-2xl font-semibold">{{ number_format($routesCount) }}</div>
        </x-filament::section>

        <x-filament::section>
            <div class="text-sm text-gray-500">System Files</div>
            <div class="text-2xl font-semibold">{{ number_format($siteFilesCount) }}</div>
        </x-filament::section>

        <x-filament::section>
            <div class="text-sm text-gray-500">Last Import</div>
            <div class="text-base font-semibold">
                {{ $lastImportedAt ? \Illuminate\Support\Carbon::parse($lastImportedAt)->toDayDateTimeString() : 'N/A' }}
            </div>
        </x-filament::section>
    </div>

    <x-filament::section>
        <div class="space-y-2">
            <h2 class="text-lg font-semibold">Ingest Flow</h2>
            <p class="text-sm text-gray-600">
                Use the header actions to import HTML from <code>../static_backup</code> into normalized tables
                (<code>content_sections</code>, <code>content_pages</code>, <code>content_page_routes</code>, <code>site_files</code>).
            </p>
            <p class="text-sm text-gray-600">
                Recommended for full sync: <code>Re-import Static Backup (Fresh)</code>.
                For incremental updates: <code>Import Incremental</code>.
            </p>
        </div>
    </x-filament::section>
</x-filament-panels::page>
