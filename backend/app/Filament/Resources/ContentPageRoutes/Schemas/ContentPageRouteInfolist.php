<?php

namespace App\Filament\Resources\ContentPageRoutes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContentPageRouteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('path'),
                IconEntry::make('is_primary')
                    ->boolean(),
                TextEntry::make('page.source_path')
                    ->label('Page source')
                    ->placeholder('-'),
                TextEntry::make('page.title')
                    ->label('Page title')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
