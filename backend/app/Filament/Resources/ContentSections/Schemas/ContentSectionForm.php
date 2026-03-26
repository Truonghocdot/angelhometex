<?php

namespace App\Filament\Resources\ContentSections\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContentSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('kind')
                    ->required()
                    ->default('catalog')
                    ->options([
                        'catalog' => 'Catalog',
                        'news' => 'News',
                        'utility' => 'Utility',
                        'generic' => 'Generic',
                    ]),
            ]);
    }
}
