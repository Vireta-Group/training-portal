<?php

namespace App\Filament\Resources\Batches\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BatchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')->searchable()->sortable(),
                TextColumn::make('course.name')->label('Course')->searchable()->sortable(),
                TextColumn::make('shift')->label('Shift')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Morning' => 'warning', 'Evening' => 'info', default => 'gray'
                    }),
                TextColumn::make('start_date')->label('Start')->date(),
                TextColumn::make('status')->label('Status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success', 'inactive' => 'danger'
                    }),
            ])
            ->filters([])
            ->recordActions([EditAction::make()->modalWidth('lg')])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
