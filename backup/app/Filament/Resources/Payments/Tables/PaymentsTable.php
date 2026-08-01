<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice.invoice_number')->searchable(),
                TextColumn::make('student.name_en')->label('Student')->searchable(),
                TextColumn::make('amount')->money('BDT')->sortable(),
                TextColumn::make('payment_date')->date()->sortable(),
                TextColumn::make('payment_method'),
                TextColumn::make('reference_number')->label('TrxID'),
            ])
            ->filters([])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
