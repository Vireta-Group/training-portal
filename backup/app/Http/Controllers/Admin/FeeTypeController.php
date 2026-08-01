<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeeType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeeTypeController extends AdminController
{
    protected function viewDir(): string
    {
        return 'fee-types';
    }

    public function index(): View
    {
        return $this->view('index');
    }

    public function data(): JsonResponse
    {
        return response()->json(['data' => FeeType::select(['id', 'name', 'name_bn', 'amount', 'is_optional', 'status'])->get()]);
    }

    public function create(): JsonResponse
    {
        return response()->json(['html' => view('admin.fee-types.form', ['feeType' => null])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable',
            'is_optional' => 'boolean',
            'status' => 'required|in:active,inactive',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        FeeType::create($data);

        return response()->json(['message' => 'Fee type created successfully']);
    }

    public function edit(FeeType $feeType): JsonResponse
    {
        return response()->json(['html' => view('admin.fee-types.form', ['feeType' => $feeType])->render()]);
    }

    public function update(Request $request, FeeType $feeType): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable',
            'is_optional' => 'boolean',
            'status' => 'required|in:active,inactive',
        ]);
        $feeType->update($data);

        return response()->json(['message' => 'Fee type updated successfully']);
    }

    public function destroy(FeeType $feeType): JsonResponse
    {
        $feeType->delete();

        return response()->json(['message' => 'Fee type deleted successfully']);
    }
}
