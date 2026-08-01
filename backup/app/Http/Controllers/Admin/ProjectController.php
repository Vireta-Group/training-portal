<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends AdminController
{
    protected function viewDir(): string
    {
        return 'projects';
    }

    public function index(): View
    {
        return $this->view('index');
    }

    public function data(): JsonResponse
    {
        $projects = Project::select(['id', 'name', 'name_bn', 'code', 'status'])->get();

        return response()->json(['data' => $projects]);
    }

    public function create(): JsonResponse
    {
        $html = view('admin.projects.form', ['project' => null])->render();

        return response()->json(['html' => $html]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'code' => 'nullable|max:50',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        Project::create($data);

        return response()->json(['message' => 'Project created successfully']);
    }

    public function edit(Project $project): JsonResponse
    {
        $html = view('admin.projects.form', ['project' => $project])->render();

        return response()->json(['html' => $html, 'project' => $project]);
    }

    public function update(Request $request, Project $project): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'code' => 'nullable|max:50',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $project->update($data);

        return response()->json(['message' => 'Project updated successfully']);
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
