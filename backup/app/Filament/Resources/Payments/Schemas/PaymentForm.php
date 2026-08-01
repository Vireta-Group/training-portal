<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('invoice_id')->relationship('invoice', 'invoice_number')->searchable()->required(),
                Select::make('student_id')->relationship('student', 'name_en')->searchable()->required(),
                TextInput::make('amount')->numeric()->required()->prefix('BDT'),
                DatePicker::make('payment_date')->required(),
                Select::make('payment_method')->options([
                    'cash' => 'Cash',
                    'bkash' => 'bKash',
                    'nagad' => 'Nagad',
                    'rocket' => 'Rocket',
                    'card' => 'Card',
                    'bank' => 'Bank Transfer',
                ]),
                TextInput::make('reference_number')->label('Reference / TrxID'),
                TextInput::make('note'),
                FileUpload::make('attachment')->directory('payments'),
            ]);
    }
}
