<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Invoice Details')->columns(2)->schema([
                    Select::make('student_id')->relationship('student', 'name_en')->searchable()->required(),
                    Select::make('batch_id')->relationship('batch', 'name')->required(),
                    TextInput::make('invoice_number')->required()->unique(ignoreRecord: true),
                    DatePicker::make('invoice_date')->required(),
                    DatePicker::make('due_date'),
                    Select::make('status')->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'overdue' => 'Overdue',
                        'cancelled' => 'Cancelled',
                    ])->default('pending'),
                    TextInput::make('total_amount')->numeric()->required()->prefix('BDT'),
                    TextInput::make('paid_amount')->numeric()->default(0)->prefix('BDT'),
                    TextInput::make('discount')->numeric()->default(0)->prefix('BDT'),
                    TextInput::make('due_amount')->numeric()->default(0)->prefix('BDT'),
                ]),
                Section::make('Fee Items')->schema([
                    Repeater::make('invoiceItems')->relationship('invoiceItems')->schema([
                        Select::make('fee_type_id')->relationship('feeType', 'name'),
                        TextInput::make('amount')->numeric()->required()->prefix('BDT'),
                        TextInput::make('description'),
                    ])->columns(3),
                ]),
            ]);
    }
}
