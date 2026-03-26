<?php

namespace App\Filament\Resources\SiteFiles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SiteFileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('path')
                    ->required()
                    ->maxLength(255),
                TextInput::make('mime_type')
                    ->required()
                    ->default('text/plain')
                    ->maxLength(255),
                Textarea::make('content')
                    ->required()
                    ->rows(20)
                    ->columnSpanFull(),
            ]);
    }
}
