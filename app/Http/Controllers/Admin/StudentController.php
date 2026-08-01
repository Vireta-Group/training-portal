<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use App\Models\Batch;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentController extends AdminController
{
    protected function viewDir(): string
    {
        return 'students';
    }

    public function index(): View
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return $this->view('index', compact('projects'));
    }

    public function data(): JsonResponse
    {
        $students = Student::with(['project:id,name', 'course:id,name', 'batch:id,name'])
            ->select(['id', 'project_id', 'course_id', 'batch_id', 'name_en', 'name_bn', 'contact', 'email', 'status', 'reference_no', 'photo_path', 'nid_path', 'created_at'])
            ->get();

        return response()->json(['data' => $students]);
    }

    public function byBatch(Batch $batch): JsonResponse
    {
        $students = Student::where('batch_id', $batch->id)
            ->select(['id', 'name_en', 'name_bn', 'father_name_en', 'mother_name_en', 'contact', 'present_village', 'present_road', 'present_po', 'present_upazila', 'present_district', 'reference_no', 'status'])
            ->get();

        return response()->json(['data' => $students, 'batch' => $batch->load('course.project')]);
    }

    public function create(): JsonResponse|RedirectResponse
    {
        if (! request()->ajax()) {
            return redirect()->route('admin.students.index');
        }

        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.students.form', ['student' => null, 'projects' => $projects])->render()]);
    }

    public function store(StudentRequest $request): JsonResponse
    {
        // Request already validated and dob normalized to Y-m-d in prepareForValidation()
        $data = $request->validated();

        $data['institute_id'] = auth()->user()->institute_id;

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->storeAs('students/photos', Str::uuid().'.'.$request->file('photo')->extension(), 'public');
        }

        if ($request->hasFile('nid')) {
            $data['nid_path'] = $request->file('nid')->storeAs('students/nid', Str::uuid().'.'.$request->file('nid')->extension(), 'public');
        }

        if ($request->hasFile('signature')) {
            $data['signature_path'] = $request->file('signature')->storeAs('students/signatures', Str::uuid().'.'.$request->file('signature')->extension(), 'public');
        }

        Student::create($data);

        return response()->json(['message' => 'Student created successfully']);
    }

    public function edit(Student $student): JsonResponse|RedirectResponse|View
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        if (request()->ajax()) {
            return response()->json(['html' => view('admin.students.form', compact('student', 'projects'))->render(), 'student' => $student]);
        }

        // Non-AJAX: render full edit page
        return $this->view('edit', compact('student', 'projects'));
    }

    /**
     * Show full student profile (admin)
     */
    public function show(Student $student): View
    {
        $student->load(['project', 'course', 'batch']);

        return $this->view('show', compact('student'));
    }

    public function print(Student $student): View
    {
        $student->load(['project', 'course', 'batch']);

        return view('admin.students.print', compact('student'));
    }

    public function update(StudentRequest $request, Student $student): JsonResponse
    {
        // Validated and dob normalized in StudentRequest
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($student->photo_path) {
                Storage::disk('public')->delete($student->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->storeAs('students/photos', Str::uuid().'.'.$request->file('photo')->extension(), 'public');
        }

        if ($request->hasFile('nid')) {
            if ($student->nid_path) {
                Storage::disk('public')->delete($student->nid_path);
            }
            $data['nid_path'] = $request->file('nid')->storeAs('students/nid', Str::uuid().'.'.$request->file('nid')->extension(), 'public');
        }

        if ($request->hasFile('signature')) {
            if ($student->signature_path) {
                Storage::disk('public')->delete($student->signature_path);
            }
            $data['signature_path'] = $request->file('signature')->storeAs('students/signatures', Str::uuid().'.'.$request->file('signature')->extension(), 'public');
        }

        $student->update($data);

        return response()->json(['message' => 'Student updated successfully']);
    }

    public function destroy(Student $student): JsonResponse
    {
        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }
        if ($student->nid_path) {
            Storage::disk('public')->delete($student->nid_path);
        }
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
