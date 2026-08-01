<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Name')->required()->maxLength(255),
                TextInput::make('name_bn')->label('Name (Bangla)')->maxLength(255),
                TextInput::make('code')->label('Code')->required()->maxLength(50)->unique(),
                Textarea::make('description')->label('Description'),
                Select::make('status')->options(['active' => 'Active', 'inactive' => 'Inactive'])->default('active')->required(),
            ]);
    }
}
