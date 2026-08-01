<?php

namespace App\Filament\Resources\Designations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DesignationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Name')->required()->maxLength(255),
                TextInput::make('name_bn')->label('Name (Bangla)'),
                Textarea::make('description')->label('Description'),
            ]);
    }
}
