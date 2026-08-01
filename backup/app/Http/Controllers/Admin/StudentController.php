<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            ->select(['id', 'project_id', 'course_id', 'batch_id', 'name_en', 'name_bn', 'contact', 'email', 'status', 'reference_no', 'created_at'])
            ->get();

        return response()->json(['data' => $students]);
    }

    public function create(): JsonResponse
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.students.form', ['student' => null, 'projects' => $projects])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'nullable|exists:batches,id',
            'name_en' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'father_name_en' => 'nullable|max:255',
            'mother_name_en' => 'nullable|max:255',
            'contact' => 'required|max:20',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'religion' => 'nullable|max:50',
            'nationality' => 'nullable|max:50',
            'blood_group' => 'nullable|max:10',
            'occupation' => 'nullable|max:255',
            'status' => 'required|in:applied,admitted,active,inactive,graduated',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        Student::create($data);

        return response()->json(['message' => 'Student created successfully']);
    }

    public function edit(Student $student): JsonResponse
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.students.form', compact('student', 'projects'))->render()]);
    }

    public function update(Request $request, Student $student): JsonResponse
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'nullable|exists:batches,id',
            'name_en' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'father_name_en' => 'nullable|max:255',
            'mother_name_en' => 'nullable|max:255',
            'contact' => 'required|max:20',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'religion' => 'nullable|max:50',
            'nationality' => 'nullable|max:50',
            'blood_group' => 'nullable|max:10',
            'occupation' => 'nullable|max:255',
            'status' => 'required|in:applied,admitted,active,inactive,graduated',
        ]);
        $student->update($data);

        return response()->json(['message' => 'Student updated successfully']);
    }

    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
