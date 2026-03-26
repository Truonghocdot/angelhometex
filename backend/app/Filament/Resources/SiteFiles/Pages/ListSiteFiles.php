<?php

namespace App\Filament\Resources\SiteFiles\Pages;

use App\Filament\Resources\SiteFiles\SiteFileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiteFiles extends ListRecords
{
    protected static string $resource = SiteFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
