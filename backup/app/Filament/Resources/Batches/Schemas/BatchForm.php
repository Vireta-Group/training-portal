<?php

namespace App\Filament\Resources\Batches\Schemas;

use App\Models\Course;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class BatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')->label('Project')
                    ->options(fn () => Project::where('status', 'active')->pluck('name', 'id'))
                    ->required()
                    ->afterStateUpdated(fn (callable $set) => $set('course_id', null)),
                Select::make('course_id')->label('Course')
                    ->options(fn (Get $get) => Course::where('project_id', $get('project_id'))->pluck('name', 'id'))
                    ->required()
                    ->afterStateUpdated(fn (callable $set) => $set('name', null)),
                TextInput::make('name')->label('Name')->required()->maxLength(255)
                    ->hidden(fn (Get $get) => blank($get('course_id'))),
                TextInput::make('name_bn')->label('Name (Bangla)')
                    ->hidden(fn (Get $get) => blank($get('course_id'))),
                DatePicker::make('start_date')->label('Start Date')->native(false)
                    ->hidden(fn (Get $get) => blank($get('course_id'))),
                DatePicker::make('end_date')->label('End Date')->native(false)
                    ->hidden(fn (Get $get) => blank($get('course_id'))),
                TextInput::make('shift')->label('Shift')->maxLength(50)
                    ->hidden(fn (Get $get) => blank($get('course_id'))),
                TextInput::make('seat_capacity')->label('Seat Capacity')->numeric()->default(0)
                    ->hidden(fn (Get $get) => blank($get('course_id'))),
                Select::make('status')->options(['active' => 'Active', 'inactive' => 'Inactive'])->default('active')->required()
                    ->hidden(fn (Get $get) => blank($get('course_id'))),
            ]);
    }
}
