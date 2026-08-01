<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\View\View;

class AttendanceStudentController extends AdminController
{
    protected function viewDir(): string
    {
        return 'attendance';
    }

    public function index(): View
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return $this->view('student', compact('projects'));
    }
}
