<?php

namespace App\Filament\Resources\ContentPageRoutes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContentPageRouteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('content_page_id')
                    ->relationship('page', 'source_path')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Page'),
                TextInput::make('path')
                    ->required()
                    ->helperText('Must start with /, for example /sitemap.html')
                    ->maxLength(255),
                Toggle::make('is_primary')
                    ->required()
                    ->inline(false),
            ]);
    }
}
