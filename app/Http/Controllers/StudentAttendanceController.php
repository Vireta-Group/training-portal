<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Project;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    private function getProjectId()
    {
        return session('current_project_id', optional(Project::where('institute_id', Auth::user()->institute_id)->first())->id);
    }

    public function index()
    {
        $batches = Batch::with('course')
            ->where('institute_id', Auth::user()->institute_id)
            ->where('project_id', $this->getProjectId())
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('attendance.index', compact('batches'));
    }

    public function batchAttendance(Batch $batch)
    {
        abort_if($batch->institute_id !== Auth::user()->institute_id, 403);

        $students = Student::where('institute_id', Auth::user()->institute_id)
            ->where('project_id', $this->getProjectId())
            ->where('batch_id', $batch->id)
            ->where('status', 'admitted')
            ->orderBy('name_en')
            ->get();

        $dates = StudentAttendance::where('institute_id', Auth::user()->institute_id)
            ->where('batch_id', $batch->id)
            ->select('date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->get()
            ->pluck('date');

        return view('attendance.batch', compact('batch', 'students', 'dates'));
    }

    public function mark(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.student_id' => 'required|exists:students,id',
            'attendances.*.status' => 'required|in:present,absent,late',
            'attendances.*.remarks' => 'nullable|string|max:500',
        ]);

        $batch = Batch::findOrFail($request->batch_id);
        abort_if($batch->institute_id !== Auth::user()->institute_id, 403);

        $date = $request->date;
        $instituteId = Auth::user()->institute_id;

        foreach ($request->attendances as $data) {
            StudentAttendance::updateOrCreate(
                [
                    'institute_id' => $instituteId,
                    'student_id' => $data['student_id'],
                    'date' => $date,
                ],
                [
                    'batch_id' => $batch->id,
                    'status' => $data['status'],
                    'remarks' => $data['remarks'] ?? null,
                ]
            );
        }

        return redirect()->route('attendance.batch', $batch->id)
            ->with('success', 'Attendance marked for '.$date);
    }

    public function report(Batch $batch)
    {
        abort_if($batch->institute_id !== Auth::user()->institute_id, 403);

        $students = Student::where('institute_id', Auth::user()->institute_id)
            ->where('batch_id', $batch->id)
            ->where('status', 'admitted')
            ->orderBy('name_en')
            ->get();

        $attendances = StudentAttendance::where('institute_id', Auth::user()->institute_id)
            ->where('batch_id', $batch->id)
            ->get()
            ->groupBy('student_id');

        $totalDays = StudentAttendance::where('institute_id', Auth::user()->institute_id)
            ->where('batch_id', $batch->id)
            ->select('date')->distinct()->count();

        return view('attendance.report', compact('batch', 'students', 'attendances', 'totalDays'));
    }
}
