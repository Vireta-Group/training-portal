<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceController extends AdminController
{
    protected function viewDir(): string
    {
        return 'invoices';
    }

    public function index(): View
    {
        $students = Student::pluck('name_en', 'id');
        $batches = Batch::pluck('name', 'id');

        return $this->view('index', compact('students', 'batches'));
    }

    public function data(): JsonResponse
    {
        $invoices = Invoice::with(['student:id,name_en', 'batch:id,name'])
            ->select(['id', 'student_id', 'batch_id', 'invoice_no', 'total_amount', 'paid_amount', 'due_amount', 'due_date', 'status'])
            ->get();

        return response()->json(['data' => $invoices]);
    }

    public function create(): JsonResponse
    {
        $students = Student::pluck('name_en', 'id');
        $batches = Batch::pluck('name', 'id');

        return response()->json(['html' => view('admin.invoices.form', ['invoice' => null, 'students' => $students, 'batches' => $batches])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'batch_id' => 'required|exists:batches,id',
            'invoice_no' => 'required|max:50|unique:invoices,invoice_no',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
            'remarks' => 'nullable',
            'status' => 'required|in:paid,partial,due,cancelled',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        $data['due_amount'] = $data['total_amount'] - $data['paid_amount'];
        Invoice::create($data);

        return response()->json(['message' => 'Invoice created successfully']);
    }

    public function edit(Invoice $invoice): JsonResponse
    {
        $students = Student::pluck('name_en', 'id');
        $batches = Batch::pluck('name', 'id');

        return response()->json(['html' => view('admin.invoices.form', compact('invoice', 'students', 'batches'))->render()]);
    }

    public function update(Request $request, Invoice $invoice): JsonResponse
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'batch_id' => 'required|exists:batches,id',
            'invoice_no' => 'required|max:50|unique:invoices,invoice_no,'.$invoice->id,
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
            'remarks' => 'nullable',
            'status' => 'required|in:paid,partial,due,cancelled',
        ]);
        $data['due_amount'] = $data['total_amount'] - $data['paid_amount'];
        $invoice->update($data);

        return response()->json(['message' => 'Invoice updated successfully']);
    }

    public function destroy(Invoice $invoice): JsonResponse
    {
        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted successfully']);
    }
}
