<?php

namespace App\Filament\Resources\Invoices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')->searchable()->sortable(),
                TextColumn::make('student.name_en')->label('Student')->searchable(),
                TextColumn::make('total_amount')->money('BDT'),
                TextColumn::make('paid_amount')->money('BDT'),
                TextColumn::make('due_amount')->money('BDT'),
                TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success', 'pending' => 'warning', 'overdue' => 'danger', 'cancelled' => 'gray', default => 'gray'
                    }),
            ])
            ->filters([])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
