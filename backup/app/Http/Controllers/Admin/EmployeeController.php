<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends AdminController
{
    protected function viewDir(): string
    {
        return 'employees';
    }

    public function index(): View
    {
        $departments = Department::where('status', 'active')->pluck('name', 'id');
        $designations = Designation::where('status', 'active')->pluck('name', 'id');

        return $this->view('index', compact('departments', 'designations'));
    }

    public function data(): JsonResponse
    {
        $employees = Employee::with(['department:id,name', 'designation:id,name'])
            ->select(['id', 'department_id', 'designation_id', 'employee_id', 'name', 'contact', 'email', 'salary', 'status'])
            ->get();

        return response()->json(['data' => $employees]);
    }

    public function create(): JsonResponse
    {
        $departments = Department::where('status', 'active')->pluck('name', 'id');
        $designations = Designation::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.employees.form', ['employee' => null, 'departments' => $departments, 'designations' => $designations])->render()]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'employee_id' => 'nullable|max:50',
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'father_name' => 'nullable|max:255',
            'mother_name' => 'nullable|max:255',
            'contact' => 'required|max:20',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'religion' => 'nullable|max:50',
            'blood_group' => 'nullable|max:10',
            'present_address' => 'nullable',
            'permanent_address' => 'nullable',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);
        $data['institute_id'] = auth()->user()->institute_id;
        Employee::create($data);

        return response()->json(['message' => 'Employee created successfully']);
    }

    public function edit(Employee $employee): JsonResponse
    {
        $departments = Department::where('status', 'active')->pluck('name', 'id');
        $designations = Designation::where('status', 'active')->pluck('name', 'id');

        return response()->json(['html' => view('admin.employees.form', compact('employee', 'departments', 'designations'))->render()]);
    }

    public function update(Request $request, Employee $employee): JsonResponse
    {
        $data = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'employee_id' => 'nullable|max:50',
            'name' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'father_name' => 'nullable|max:255',
            'mother_name' => 'nullable|max:255',
            'contact' => 'required|max:20',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'religion' => 'nullable|max:50',
            'blood_group' => 'nullable|max:10',
            'present_address' => 'nullable',
            'permanent_address' => 'nullable',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);
        $employee->update($data);

        return response()->json(['message' => 'Employee updated successfully']);
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
