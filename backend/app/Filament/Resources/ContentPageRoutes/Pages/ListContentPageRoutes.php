<?php

namespace App\Filament\Resources\ContentPageRoutes\Pages;

use App\Filament\Resources\ContentPageRoutes\ContentPageRouteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContentPageRoutes extends ListRecords
{
    protected static string $resource = ContentPageRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
