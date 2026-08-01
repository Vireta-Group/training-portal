<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends AdminController
{
    protected function viewDir(): string
    {
        return 'departments';
    }

    public function index(): View
    {
        return $this->view('index');
    }

    public function data(): JsonResponse
    {
        return response()->json(['data' => Department::select(['id', 'name', 'name_bn', 'status'])->get()]);
    }

    public function create(): JsonResponse
    {
        return response()->json(['html' => view('admin.departments.form', ['department' => null])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        Department::create($data);

        return response()->json(['message' => 'Department created successfully']);
    }

    public function edit(Department $department): JsonResponse
    {
        return response()->json(['html' => view('admin.departments.form', ['department' => $department])->render()]);
    }

    public function update(Request $request, Department $department): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $department->update($data);

        return response()->json(['message' => 'Department updated successfully']);
    }

    public function destroy(Department $department): JsonResponse
    {
        $department->delete();

        return response()->json(['message' => 'Department deleted successfully']);
    }
}
