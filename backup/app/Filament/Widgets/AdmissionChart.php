<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class AdmissionChart extends ChartWidget
{
    protected ?string $heading = 'Admission Status';

    protected function getData(): array
    {
        $instituteId = Auth::user()->institute_id;

        $applied = Student::where('institute_id', $instituteId)->where('status', 'applied')->count();
        $admitted = Student::where('institute_id', $instituteId)->where('status', 'admitted')->count();
        $rejected = Student::where('institute_id', $instituteId)->where('status', 'rejected')->count();

        return [
            'labels' => ['Applied', 'Admitted', 'Rejected'],
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => [$applied, $admitted, $rejected],
                    'backgroundColor' => ['#f59e0b', '#10b981', '#ef4444'],
                    'borderColor' => ['#d97706', '#059669', '#dc2626'],
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
