<?php

namespace App\Filament\Resources\ContentPages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContentPageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('section.name')
                    ->label('Section')
                    ->placeholder('-'),
                TextEntry::make('source_path'),
                TextEntry::make('primaryRoute.path')
                    ->label('Primary URL')
                    ->placeholder('-'),
                IconEntry::make('is_homepage')
                    ->boolean(),
                TextEntry::make('title')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('canonical_url')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('meta_description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('meta_keywords')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('html')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ])
            ->columns(2);
    }
}
