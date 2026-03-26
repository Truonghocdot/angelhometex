<?php

namespace App\Filament\Resources\ContentPageRoutes\Pages;

use App\Filament\Resources\ContentPageRoutes\ContentPageRouteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContentPageRoute extends ViewRecord
{
    protected static string $resource = ContentPageRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
