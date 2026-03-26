<?php

namespace App\Filament\Resources\ContentSections\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContentSectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('slug'),
                TextEntry::make('name'),
                TextEntry::make('kind')
                    ->badge(),
                TextEntry::make('pages_count')
                    ->counts('pages')
                    ->label('Pages'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
