<?php

namespace App\Filament\Resources\ContentPageRoutes\Pages;

use App\Filament\Resources\ContentPageRoutes\ContentPageRouteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditContentPageRoute extends EditRecord
{
    protected static string $resource = ContentPageRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
