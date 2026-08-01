<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends AdminController
{
    public function index(): View
    {
        $stats = [
            'students' => Student::count(),
            'courses' => Course::count(),
            'revenue' => Payment::sum('amount'),
            'projects' => Project::where('status', 'active')->count(),
        ];

        return $this->view('dashboard.index', compact('stats'));
    }

    public function chartAdmissions(): JsonResponse
    {
        $data = Student::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return response()->json([
            'labels' => $data->keys(),
            'values' => $data->values(),
        ]);
    }

    public function chartRevenue(): JsonResponse
    {
        $data = Payment::selectRaw("TO_CHAR(created_at, 'YYYY-MM') as month, SUM(amount) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->limit(12)
            ->get();

        return response()->json([
            'labels' => $data->pluck('month'),
            'values' => $data->pluck('total'),
        ]);
    }
}
