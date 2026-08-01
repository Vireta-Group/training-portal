<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAttendanceController extends Controller
{
    private function getInstituteId()
    {
        return Auth::user()->institute_id;
    }

    public function index()
    {
        $attendances = EmployeeAttendance::with('employee')
            ->where('institute_id', $this->getInstituteId())
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('date');

        return view('hr.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::where('institute_id', $this->getInstituteId())
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('hr.attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.employee_id' => 'required|exists:employees,id',
            'attendances.*.status' => 'required|in:present,absent,late,leave',
            'attendances.*.check_in' => 'nullable|string',
            'attendances.*.check_out' => 'nullable|string',
            'attendances.*.remarks' => 'nullable|string|max:500',
        ]);

        $date = $request->date;
        $instituteId = $this->getInstituteId();

        foreach ($request->attendances as $data) {
            EmployeeAttendance::updateOrCreate(
                [
                    'institute_id' => $instituteId,
                    'employee_id' => $data['employee_id'],
                    'date' => $date,
                ],
                [
                    'status' => $data['status'],
                    'check_in' => $data['check_in'] ?? null,
                    'check_out' => $data['check_out'] ?? null,
                    'remarks' => $data['remarks'] ?? null,
                ]
            );
        }

        return redirect()->route('hr.attendance.index')->with('success', 'Attendance recorded for '.$date);
    }

    public function show($date)
    {
        $attendances = EmployeeAttendance::with('employee')
            ->where('institute_id', $this->getInstituteId())
            ->where('date', $date)
            ->get();

        return view('hr.attendance.show', compact('attendances', 'date'));
    }
}
