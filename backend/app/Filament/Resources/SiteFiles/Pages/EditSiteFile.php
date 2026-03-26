<?php

namespace App\Filament\Resources\SiteFiles\Pages;

use App\Filament\Resources\SiteFiles\SiteFileResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSiteFile extends EditRecord
{
    protected static string $resource = SiteFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
