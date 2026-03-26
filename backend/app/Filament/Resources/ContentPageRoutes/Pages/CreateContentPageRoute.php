<?php

namespace App\Filament\Resources\ContentPageRoutes\Pages;

use App\Filament\Resources\ContentPageRoutes\ContentPageRouteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContentPageRoute extends CreateRecord
{
    protected static string $resource = ContentPageRouteResource::class;
}
