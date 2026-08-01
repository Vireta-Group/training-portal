<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeeType;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends AdminController
{
    protected function viewDir(): string
    {
        return 'payments';
    }

    public function index(): View
    {
        $students = Student::pluck('name_en', 'id');
        $feeTypes = FeeType::pluck('name', 'id');

        return $this->view('index', compact('students', 'feeTypes'));
    }

    public function data(): JsonResponse
    {
        $payments = Payment::with(['student:id,name_en', 'feeType:id,name', 'invoice:id,invoice_no'])
            ->select(['id', 'student_id', 'invoice_id', 'fee_type_id', 'amount', 'payment_date', 'payment_method', 'reference_no'])
            ->get();

        return response()->json(['data' => $payments]);
    }

    public function create(): JsonResponse
    {
        $students = Student::pluck('name_en', 'id');
        $invoices = Invoice::pluck('invoice_no', 'id');
        $feeTypes = FeeType::pluck('name', 'id');

        return response()->json(['html' => view('admin.payments.form', ['payment' => null, 'students' => $students, 'invoices' => $invoices, 'feeTypes' => $feeTypes])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'invoice_id' => 'nullable|exists:invoices,id',
            'fee_type_id' => 'nullable|exists:fee_types,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,bank,online,other',
            'reference_no' => 'nullable|max:255',
            'remarks' => 'nullable',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        Payment::create($data);

        return response()->json(['message' => 'Payment created successfully']);
    }

    public function edit(Payment $payment): JsonResponse
    {
        $students = Student::pluck('name_en', 'id');
        $invoices = Invoice::pluck('invoice_no', 'id');
        $feeTypes = FeeType::pluck('name', 'id');

        return response()->json(['html' => view('admin.payments.form', compact('payment', 'students', 'invoices', 'feeTypes'))->render()]);
    }

    public function update(Request $request, Payment $payment): JsonResponse
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'invoice_id' => 'nullable|exists:invoices,id',
            'fee_type_id' => 'nullable|exists:fee_types,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,bank,online,other',
            'reference_no' => 'nullable|max:255',
            'remarks' => 'nullable',
        ]);
        $payment->update($data);

        return response()->json(['message' => 'Payment updated successfully']);
    }

    public function destroy(Payment $payment): JsonResponse
    {
        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
