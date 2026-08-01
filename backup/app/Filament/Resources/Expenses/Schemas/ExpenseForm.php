<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->maxLength(255),
                Select::make('expense_category')->options([
                    'utilities' => 'Utilities',
                    'salary' => 'Salary',
                    'rent' => 'Rent',
                    'equipment' => 'Equipment',
                    'supplies' => 'Supplies',
                    'maintenance' => 'Maintenance',
                    'marketing' => 'Marketing',
                    'other' => 'Other',
                ]),
                TextInput::make('amount')->numeric()->required()->prefix('BDT'),
                DatePicker::make('expense_date')->required(),
                Select::make('paid_by')->relationship('paidBy', 'name'),
                Select::make('approved_by')->relationship('approvedBy', 'name'),
                TextInput::make('note'),
                FileUpload::make('receipt')->directory('expenses'),
            ]);
    }
}
