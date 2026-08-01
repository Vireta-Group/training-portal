<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Models\Project;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')->label('Project')->relationship('project', 'name')
                    ->options(fn () => Project::where('status', 'active')->pluck('name', 'id'))
                    ->required(),
                TextInput::make('name')->label('Name')->required()->maxLength(255),
                TextInput::make('name_bn')->label('Name (Bangla)')->maxLength(255),
                TextInput::make('duration')->label('Duration (months)')->numeric()->required(),
                TextInput::make('fee')->label('Fee')->numeric()->prefix('??????'),
                TextInput::make('seat_capacity')->label('Seat Capacity')->numeric(),
                Textarea::make('description')->label('Description'),
                Select::make('status')->options(['active' => 'Active', 'inactive' => 'Inactive'])->default('active')->required(),
            ]);
    }
}
