<?php

namespace App\Filament\Pages;

use App\Models\ContentPage;
use App\Models\ContentPageRoute;
use App\Models\ContentSection;
use App\Models\SiteFile;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Artisan;

class ContentIngestOverview extends Page
{
    protected static ?string $title = 'Content Ingest';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

    protected static string|\UnitEnum|null $navigationGroup = 'Operations';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.content-ingest-overview';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('importFresh')
                ->label('Re-import Static Backup (Fresh)')
                ->requiresConfirmation()
                ->color('warning')
                ->action(function (): void {
                    Artisan::call('content:import-static', ['--fresh' => true]);

                    Notification::make()
                        ->title('Static backup imported')
                        ->body(trim(Artisan::output()) ?: 'Import completed successfully.')
                        ->success()
                        ->send();
                }),
            Action::make('importIncremental')
                ->label('Import Incremental')
                ->action(function (): void {
                    Artisan::call('content:import-static');

                    Notification::make()
                        ->title('Incremental import completed')
                        ->body(trim(Artisan::output()) ?: 'Import completed successfully.')
                        ->success()
                        ->send();
                }),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'sectionsCount' => ContentSection::query()->count(),
            'pagesCount' => ContentPage::query()->count(),
            'routesCount' => ContentPageRoute::query()->count(),
            'siteFilesCount' => SiteFile::query()->count(),
            'lastImportedAt' => ContentPage::query()->max('updated_at'),
        ];
    }
}
