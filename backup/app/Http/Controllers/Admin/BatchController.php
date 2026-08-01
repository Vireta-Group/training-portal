<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BatchController extends AdminController
{
    protected function viewDir(): string
    {
        return 'batches';
    }

    public function index(): View
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return $this->view('index', compact('projects'));
    }

    public function data(): JsonResponse
    {
        $batches = Batch::with(['project:id,name', 'course:id,name'])
            ->select(['id', 'project_id', 'course_id', 'name', 'name_bn', 'start_date', 'end_date', 'shift', 'seat_capacity', 'status'])
            ->get();

        return response()->json(['data' => $batches]);
    }

    public function byCourse(Course $course): JsonResponse
    {
        return response()->json(Batch::where('course_id', $course->id)->pluck('name', 'id'));
    }

    public function create(): JsonResponse
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.batches.form', ['batch' => null, 'projects' => $projects])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'shift' => 'nullable|max:50',
            'seat_capacity' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        Batch::create($data);

        return response()->json(['message' => 'Batch created successfully']);
    }

    public function edit(Batch $batch): JsonResponse
    {
        $projects = Project::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.batches.form', compact('batch', 'projects'))->render()]);
    }

    public function update(Request $request, Batch $batch): JsonResponse
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'shift' => 'nullable|max:50',
            'seat_capacity' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);
        $batch->update($data);

        return response()->json(['message' => 'Batch updated successfully']);
    }

    public function destroy(Batch $batch): JsonResponse
    {
        $batch->delete();

        return response()->json(['message' => 'Batch deleted successfully']);
    }
}
