<?php

namespace App\Filament\Widgets;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $instituteId = Auth::user()->institute_id;

        return [
            Stat::make('Students', Student::where('institute_id', $instituteId)->count())
                ->description(Student::where('institute_id', $instituteId)->where('status', 'admitted')->count().' admitted, '.Student::where('institute_id', $instituteId)->where('status', 'applied')->count().' applied')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success'),
            Stat::make('Courses', Course::where('institute_id', $instituteId)->count())
                ->description(Batch::where('institute_id', $instituteId)->count().' batches across '.Project::where('institute_id', $instituteId)->count().' projects')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('info'),
            Stat::make('Revenue', 'BDT '.number_format(Invoice::whereHas('student', fn ($q) => $q->where('institute_id', $instituteId))->where('status', 'paid')->sum('total_amount'), 0))
                ->description(Invoice::where('status', 'pending')->count().' pending invoices')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('warning'),
            Stat::make('Active Projects', Project::where('institute_id', $instituteId)->where('status', 'active')->count())
                ->description(Project::where('institute_id', $instituteId)->count().' total projects')
                ->descriptionIcon('heroicon-o-folder-open')
                ->color('primary'),
        ];
    }
}
