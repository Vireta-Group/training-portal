<?php

namespace App\Filament\Pages;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class AttendanceEmployee extends Page implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected string $view = 'filament.pages.attendance-employee';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $title = 'Employee Attendance';

    protected static UnitEnum|string|null $navigationGroup = 'Attendance';

    public ?array $data = [];

    public $employees = [];

    public function mount(): void
    {
        $this->form->fill();
        $this->loadEmployees();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')
                    ->label('Attendance Date')
                    ->default(now()->toDateString())
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn () => $this->loadEmployees()),
            ])
            ->statePath('data');
    }

    public function loadEmployees(): void
    {
        $employees = Employee::where('institute_id', Auth::user()->institute_id)
            ->where('employment_status', 'active')
            ->orderBy('name')
            ->get();

        $date = $this->data['date'] ?? now()->toDateString();

        $this->employees = $employees->map(function ($employee) use ($date) {
            $existing = EmployeeAttendance::where('institute_id', Auth::user()->institute_id)
                ->where('employee_id', $employee->id)
                ->where('date', $date)
                ->first();

            return [
                'employee_id' => $employee->id,
                'name' => $employee->name.($employee->designation?->name ? " ({$employee->designation->name})" : ''),
                'status' => $existing?->status ?? 'present',
                'check_in' => $existing?->check_in?->format('H:i') ?? '',
                'check_out' => $existing?->check_out?->format('H:i') ?? '',
                'remarks' => $existing?->remarks ?? '',
            ];
        })->toArray();
    }

    public function saveAction(): Action
    {
        return Action::make('save')
            ->label('Save Attendance')
            ->action(function () {
                $this->validate();

                $date = $this->data['date'];
                $instituteId = Auth::user()->institute_id;

                foreach ($this->employees as $empData) {
                    EmployeeAttendance::updateOrCreate(
                        [
                            'institute_id' => $instituteId,
                            'employee_id' => $empData['employee_id'],
                            'date' => $date,
                        ],
                        [
                            'status' => $empData['status'],
                            'check_in' => $empData['check_in'] ?? null,
                            'check_out' => $empData['check_out'] ?? null,
                            'remarks' => $empData['remarks'] ?? null,
                        ]
                    );
                }

                Notification::make()->success()->title("Attendance saved for {$date}")->send();
            });
    }
}
