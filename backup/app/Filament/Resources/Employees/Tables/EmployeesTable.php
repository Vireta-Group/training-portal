<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('department.name'),
                TextColumn::make('designation.name'),
                TextColumn::make('phone'),
                TextColumn::make('employment_status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success', 'inactive' => 'gray', 'resigned' => 'danger', 'terminated' => 'danger', default => 'gray'
                    }),
                TextColumn::make('salary')->money('BDT'),
            ])
            ->filters([])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
