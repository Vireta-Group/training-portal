<?php

namespace App\Filament\Resources\FeeTypes\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FeeTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Name')->required()->maxLength(255),
                TextInput::make('name_bn')->label('Name (Bangla)'),
                TextInput::make('amount')->label('Amount')->numeric()->required()->prefix('??????'),
                Textarea::make('description')->label('Description'),
                Toggle::make('is_optional')->label('Optional?'),
                Toggle::make('status')->label('Active')->default(true),
            ]);
    }
}
