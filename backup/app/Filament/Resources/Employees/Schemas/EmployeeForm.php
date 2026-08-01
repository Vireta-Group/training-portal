<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Info')->columns(2)->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('email')->email()->unique(ignoreRecord: true),
                    TextInput::make('phone')->maxLength(20),
                    Select::make('department_id')->relationship('department', 'name'),
                    Select::make('designation_id')->relationship('designation', 'name'),
                    Select::make('employee_type')->options([
                        'full_time' => 'Full Time',
                        'part_time' => 'Part Time',
                        'contractual' => 'Contractual',
                    ]),
                    Select::make('employment_status')->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'resigned' => 'Resigned',
                        'terminated' => 'Terminated',
                    ]),
                    DatePicker::make('joining_date'),
                    TextInput::make('salary')->numeric()->prefix('BDT'),
                ]),
                Section::make('Personal')->columns(2)->schema([
                    TextInput::make('father_name'),
                    TextInput::make('mother_name'),
                    DatePicker::make('dob')->label('Date of Birth'),
                    Select::make('gender')->options(['Male' => 'Male', 'Female' => 'Female']),
                    TextInput::make('nid')->label('NID Number'),
                    TextInput::make('present_address'),
                    TextInput::make('permanent_address'),
                ]),
                Section::make('Documents')->schema([
                    FileUpload::make('photo')->image()->directory('employees/photos'),
                    FileUpload::make('cv_path')->label('CV')->directory('employees/cv'),
                    FileUpload::make('certificates')->multiple()->directory('employees/certificates'),
                ]),
            ]);
    }
}
