<?php

namespace App\Filament\Resources\ContentPageRoutes;

use App\Filament\Resources\ContentPageRoutes\Pages\CreateContentPageRoute;
use App\Filament\Resources\ContentPageRoutes\Pages\EditContentPageRoute;
use App\Filament\Resources\ContentPageRoutes\Pages\ListContentPageRoutes;
use App\Filament\Resources\ContentPageRoutes\Pages\ViewContentPageRoute;
use App\Filament\Resources\ContentPageRoutes\Schemas\ContentPageRouteForm;
use App\Filament\Resources\ContentPageRoutes\Schemas\ContentPageRouteInfolist;
use App\Filament\Resources\ContentPageRoutes\Tables\ContentPageRoutesTable;
use App\Models\ContentPageRoute;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContentPageRouteResource extends Resource
{
    protected static ?string $model = ContentPageRoute::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;

    protected static ?string $navigationLabel = 'Page Routes';

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 30;

    public static function form(Schema $schema): Schema
    {
        return ContentPageRouteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContentPageRouteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContentPageRoutesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContentPageRoutes::route('/'),
            'create' => CreateContentPageRoute::route('/create'),
            'view' => ViewContentPageRoute::route('/{record}'),
            'edit' => EditContentPageRoute::route('/{record}/edit'),
        ];
    }
}
