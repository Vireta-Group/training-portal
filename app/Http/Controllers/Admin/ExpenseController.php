<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseController extends AdminController
{
    protected function viewDir(): string
    {
        return 'expenses';
    }

    public function index(): View
    {
        return $this->view('index');
    }

    public function data(): JsonResponse
    {
        $expenses = Expense::select(['id', 'category', 'amount', 'description', 'date', 'status'])->get();

        return response()->json(['data' => $expenses]);
    }

    public function create(): JsonResponse
    {
        return response()->json(['html' => view('admin.expenses.form', ['expense' => null])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'category' => 'required|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        Expense::create($data);

        return response()->json(['message' => 'Expense created successfully']);
    }

    public function edit(Expense $expense): JsonResponse
    {
        return response()->json(['html' => view('admin.expenses.form', ['expense' => $expense])->render()]);
    }

    public function update(Request $request, Expense $expense): JsonResponse
    {
        $data = $request->validate([
            'category' => 'required|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable',
            'date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);
        $expense->update($data);

        return response()->json(['message' => 'Expense updated successfully']);
    }

    public function destroy(Expense $expense): JsonResponse
    {
        $expense->delete();

        return response()->json(['message' => 'Expense deleted successfully']);
    }
}
