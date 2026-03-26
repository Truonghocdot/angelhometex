<?php

namespace App\Filament\Resources\SiteFiles\Pages;

use App\Filament\Resources\SiteFiles\SiteFileResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSiteFile extends ViewRecord
{
    protected static string $resource = SiteFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
