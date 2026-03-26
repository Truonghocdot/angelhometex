<?php

namespace App\Filament\Resources\ContentSections;

use App\Filament\Resources\ContentSections\Pages\CreateContentSection;
use App\Filament\Resources\ContentSections\Pages\EditContentSection;
use App\Filament\Resources\ContentSections\Pages\ListContentSections;
use App\Filament\Resources\ContentSections\Pages\ViewContentSection;
use App\Filament\Resources\ContentSections\Schemas\ContentSectionForm;
use App\Filament\Resources\ContentSections\Schemas\ContentSectionInfolist;
use App\Filament\Resources\ContentSections\Tables\ContentSectionsTable;
use App\Models\ContentSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContentSectionResource extends Resource
{
    protected static ?string $model = ContentSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    protected static ?string $navigationLabel = 'Sections';

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 20;

    public static function form(Schema $schema): Schema
    {
        return ContentSectionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContentSectionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContentSectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContentSections::route('/'),
            'create' => CreateContentSection::route('/create'),
            'view' => ViewContentSection::route('/{record}'),
            'edit' => EditContentSection::route('/{record}/edit'),
        ];
    }
}
