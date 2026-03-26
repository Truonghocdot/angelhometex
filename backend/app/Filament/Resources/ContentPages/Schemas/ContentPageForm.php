<?php

namespace App\Filament\Resources\ContentPages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContentPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('content_section_id')
                    ->relationship('section', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Section'),
                TextInput::make('source_path')
                    ->required()
                    ->maxLength(255),
                Toggle::make('is_homepage')
                    ->inline(false)
                    ->required(),
                TextInput::make('title')
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('canonical_url')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('meta_keywords')
                    ->rows(2)
                    ->columnSpanFull(),
                Textarea::make('html')
                    ->required()
                    ->rows(24)
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
