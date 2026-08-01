<?php

namespace App\Filament\Resources\Students\Schemas;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Enrollment')->columns(2)->schema([
                    Select::make('project_id')->label('Project')
                        ->options(fn () => Project::where('status', 'active')->pluck('name', 'id'))
                        ->required()
                        ->afterStateUpdated(fn (callable $set) => $set('course_id', null)),
                    Select::make('course_id')->label('Course')
                        ->options(fn (Get $get) => Course::where('project_id', $get('project_id'))->pluck('name', 'id'))
                        ->required()
                        ->afterStateUpdated(fn (callable $set) => $set('batch_id', null)),
                    Select::make('batch_id')->label('Batch')
                        ->options(fn (Get $get) => Batch::where('course_id', $get('course_id'))->pluck('name', 'id'))
                        ->hidden(fn (Get $get) => blank($get('course_id'))),
                ]),
                Section::make('Personal Info')->columns(2)->schema([
                    TextInput::make('name_en')->label('Name (English)')->required()->maxLength(255),
                    TextInput::make('name_bn')->label('Name (Bangla)'),
                    TextInput::make('father_name_en')->label('Father Name'),
                    TextInput::make('mother_name_en')->label('Mother Name'),
                    TextInput::make('contact')->label('Mobile')->required()->maxLength(20),
                    TextInput::make('email')->email(),
                    DatePicker::make('dob')->label('Date of Birth'),
                    Select::make('gender')->options(['Male' => 'Male', 'Female' => 'Female']),
                    Select::make('religion')->options(['Islam' => 'Islam', 'Hinduism' => 'Hinduism', 'Buddhism' => 'Buddhism', 'Christianity' => 'Christianity']),
                    TextInput::make('nationality')->default('Bangladeshi'),
                    Select::make('blood_group')->options(['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-']),
                    TextInput::make('occupation'),
                ]),
                Section::make('Status & Documents')->columns(2)->schema([
                    Select::make('status')->options(['applied' => 'Applied', 'admitted' => 'Admitted', 'active' => 'Active', 'inactive' => 'Inactive', 'graduated' => 'Graduated'])->default('applied'),
                    FileUpload::make('photo_path')->label('Photo')->image()->directory('students/photos'),
                    FileUpload::make('signature_path')->label('Signature')->image()->directory('students/signatures'),
                    FileUpload::make('nid_path')->label('NID')->directory('students/nid'),
                ]),
            ]);
    }
}
