<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\View\View;

class AttendanceEmployeeController extends AdminController
{
    protected function viewDir(): string
    {
        return 'attendance';
    }

    public function index(): View
    {
        $departments = Department::where('status', 'active')->pluck('name', 'id');

        return $this->view('employee', compact('departments'));
    }
}
