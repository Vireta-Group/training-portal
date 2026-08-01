<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends AdminController
{
    protected function viewDir(): string
    {
        return 'courses';
    }

    public function index(): View
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return $this->view('index', compact('projects'));
    }

    public function data(): JsonResponse
    {
        $courses = Course::with('project:id,name')
            ->select(['id', 'project_id', 'name', 'name_bn', 'duration', 'fee', 'status'])
            ->get();

        return response()->json(['data' => $courses]);
    }

    public function byProject(Project $project): JsonResponse
    {
        return response()->json(Course::where('project_id', $project->id)->pluck('name', 'id'));
    }

    public function create(): JsonResponse
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.courses.form', ['course' => null, 'projects' => $projects])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'duration' => 'required|numeric|min:1',
            'fee' => 'required|numeric|min:0',
            'seat_capacity' => 'nullable|numeric|min:0',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        Course::create($data);

        return response()->json(['message' => 'Course created successfully']);
    }

    public function edit(Course $course): JsonResponse
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.courses.form', compact('course', 'projects'))->render()]);
    }

    public function update(Request $request, Course $course): JsonResponse
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'duration' => 'required|numeric|min:1',
            'fee' => 'required|numeric|min:0',
            'seat_capacity' => 'nullable|numeric|min:0',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $course->update($data);

        return response()->json(['message' => 'Course updated successfully']);
    }

    public function destroy(Course $course): JsonResponse
    {
        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }
}
