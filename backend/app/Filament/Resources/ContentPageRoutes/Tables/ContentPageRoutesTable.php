<?php

namespace App\Filament\Resources\ContentPageRoutes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContentPageRoutesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('path')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('page.source_path')
                    ->label('Page Source')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('page.title')
                    ->label('Page Title')
                    ->searchable()
                    ->limit(50)
                    ->toggleable(),
                IconColumn::make('is_primary')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_primary')
                    ->label('Primary route'),
            ])
            ->defaultSort('path')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
