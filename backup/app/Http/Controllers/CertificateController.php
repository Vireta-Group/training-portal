<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    private function getProjectId()
    {
        return session('current_project_id', optional(Project::where('institute_id', Auth::user()->institute_id)->first())->id);
    }

    public function index()
    {
        $certificates = Certificate::with(['student', 'batch', 'course'])
            ->where('institute_id', Auth::user()->institute_id)
            ->orderBy('issue_date', 'desc')
            ->get();

        return view('certificates.index', compact('certificates'));
    }

    public function create()
    {
        $students = Student::with(['course', 'batch'])
            ->where('institute_id', Auth::user()->institute_id)
            ->where('project_id', $this->getProjectId())
            ->where('status', 'admitted')
            ->orderBy('name_en')
            ->get();

        return view('certificates.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'batch_id' => 'nullable|exists:batches,id',
            'course_id' => 'nullable|exists:courses,id',
            'issue_date' => 'required|date',
            'template' => 'nullable|string|max:100',
            'remarks' => 'nullable|string|max:500',
        ]);

        $student = Student::findOrFail($request->student_id);
        abort_if($student->institute_id !== Auth::user()->institute_id, 403);

        $year = now()->format('Y');
        $last = Certificate::where('institute_id', Auth::user()->institute_id)
            ->whereYear('created_at', $year)->count();
        $certNo = 'CERT-'.$year.'-'.str_pad($last + 1, 4, '0', STR_PAD_LEFT);

        Certificate::create([
            'institute_id' => Auth::user()->institute_id,
            'student_id' => $request->student_id,
            'batch_id' => $request->batch_id ?? $student->batch_id,
            'course_id' => $request->course_id ?? $student->course_id,
            'certificate_no' => $certNo,
            'issue_date' => $request->issue_date,
            'template' => $request->template ?? 'default',
            'status' => 'issued',
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('certificates.index')->with('success', 'Certificate issued successfully.');
    }

    public function show(Certificate $certificate)
    {
        abort_if($certificate->institute_id !== Auth::user()->institute_id, 403);
        $certificate->load(['student', 'batch', 'course', 'student.institute']);

        return view('certificates.show', compact('certificate'));
    }

    public function destroy(Certificate $certificate)
    {
        abort_if($certificate->institute_id !== Auth::user()->institute_id, 403);
        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
