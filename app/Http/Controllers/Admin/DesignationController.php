<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DesignationController extends AdminController
{
    protected function viewDir(): string
    {
        return 'designations';
    }

    public function index(): View
    {
        return $this->view('index');
    }

    public function data(): JsonResponse
    {
        return response()->json(['data' => Designation::select(['id', 'name', 'name_bn', 'status'])->get()]);
    }

    public function create(): JsonResponse
    {
        return response()->json(['html' => view('admin.designations.form', ['designation' => null])->render()]);
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
        Designation::create($data);

        return response()->json(['message' => 'Designation created successfully']);
    }

    public function edit(Designation $designation): JsonResponse
    {
        return response()->json(['html' => view('admin.designations.form', ['designation' => $designation])->render()]);
    }

    public function update(Request $request, Designation $designation): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);
        $designation->update($data);

        return response()->json(['message' => 'Designation updated successfully']);
    }

    public function destroy(Designation $designation): JsonResponse
    {
        $designation->delete();

        return response()->json(['message' => 'Designation deleted successfully']);
    }
}
