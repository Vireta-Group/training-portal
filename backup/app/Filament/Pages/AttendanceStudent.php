<?php

namespace App\Filament\Pages;

use App\Models\Batch;
use App\Models\Student;
use App\Models\StudentAttendance;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class AttendanceStudent extends Page implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected string $view = 'filament.pages.attendance-student';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $title = 'Attendance';

    protected static UnitEnum|string|null $navigationGroup = 'Attendance';

    public ?array $data = [];

    public $students = [];

    public $date;

    public $selectedBatchId;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('batch_id')
                    ->label('Select Batch')
                    ->options(fn () => Batch::query()
                        ->where('institute_id', Auth::user()->institute_id)
                        ->where('status', 'active')
                        ->with('course')
                        ->get()
                        ->mapWithKeys(fn ($b) => [$b->id => $b->name.' ('.($b->course->name ?? '').')'])
                    )
                    ->searchable()
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state) {
                        $this->selectedBatchId = $state;
                        $this->loadStudents();
                    }),
                DatePicker::make('date')
                    ->label('Attendance Date')
                    ->default(now()->toDateString())
                    ->required()
                    ->live(),
            ])
            ->statePath('data');
    }

    public function loadStudents(): void
    {
        if (! $this->selectedBatchId) {
            $this->students = [];

            return;
        }

        $batch = Batch::find($this->selectedBatchId);
        if (! $batch || $batch->institute_id !== Auth::user()->institute_id) {
            $this->students = [];

            return;
        }

        $students = Student::where('institute_id', Auth::user()->institute_id)
            ->where('batch_id', $this->selectedBatchId)
            ->where('status', 'admitted')
            ->orderBy('name_en')
            ->get();

        $date = $this->data['date'] ?? now()->toDateString();

        $this->students = $students->map(function ($student) use ($date) {
            $existing = StudentAttendance::where('institute_id', Auth::user()->institute_id)
                ->where('student_id', $student->id)
                ->where('date', $date)
                ->first();

            return [
                'student_id' => $student->id,
                'name' => $student->name_en.($student->name_bn ? " ({$student->name_bn})" : ''),
                'status' => $existing?->status ?? 'present',
                'remarks' => $existing?->remarks ?? '',
            ];
        })->toArray();
    }

    public function updated($property): void
    {
        if (in_array($property, ['data.batch_id', 'data.date'])) {
            $this->loadStudents();
        }
    }

    public function saveAction(): Action
    {
        return Action::make('save')
            ->label('Save Attendance')
            ->action(function () {
                $this->validate();

                $batchId = $this->data['batch_id'];
                $date = $this->data['date'];
                $instituteId = Auth::user()->institute_id;

                $batch = Batch::find($batchId);
                if (! $batch || $batch->institute_id !== $instituteId) {
                    Notification::make()->danger()->title('Invalid batch')->send();

                    return;
                }

                foreach ($this->students as $studentData) {
                    StudentAttendance::updateOrCreate(
                        [
                            'institute_id' => $instituteId,
                            'student_id' => $studentData['student_id'],
                            'date' => $date,
                        ],
                        [
                            'batch_id' => $batchId,
                            'status' => $studentData['status'],
                            'remarks' => $studentData['remarks'] ?? null,
                        ]
                    );
                }

                Notification::make()->success()->title("Attendance saved for {$date}")->send();
            });
    }

    public function getBatchesWithAttendance(): array
    {
        if (! $this->selectedBatchId) {
            return [];
        }

        return StudentAttendance::where('institute_id', Auth::user()->institute_id)
            ->where('batch_id', $this->selectedBatchId)
            ->selectRaw('DISTINCT DATE(date) as att_date')
            ->orderBy('att_date', 'desc')
            ->pluck('att_date')
            ->toArray();
    }
}
