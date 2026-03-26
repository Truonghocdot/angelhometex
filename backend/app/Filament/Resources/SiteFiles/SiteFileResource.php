<?php

namespace App\Filament\Resources\SiteFiles;

use App\Filament\Resources\SiteFiles\Pages\CreateSiteFile;
use App\Filament\Resources\SiteFiles\Pages\EditSiteFile;
use App\Filament\Resources\SiteFiles\Pages\ListSiteFiles;
use App\Filament\Resources\SiteFiles\Pages\ViewSiteFile;
use App\Filament\Resources\SiteFiles\Schemas\SiteFileForm;
use App\Filament\Resources\SiteFiles\Schemas\SiteFileInfolist;
use App\Filament\Resources\SiteFiles\Tables\SiteFilesTable;
use App\Models\SiteFile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SiteFileResource extends Resource
{
    protected static ?string $model = SiteFile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog8Tooth;

    protected static ?string $navigationLabel = 'Site Files';

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return SiteFileForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SiteFileInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteFilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteFiles::route('/'),
            'create' => CreateSiteFile::route('/create'),
            'view' => ViewSiteFile::route('/{record}'),
            'edit' => EditSiteFile::route('/{record}/edit'),
        ];
    }
}
