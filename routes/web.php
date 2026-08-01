<?php

use App\Http\Controllers\Admin\AttendanceEmployeeController;
use App\Http\Controllers\Admin\AttendanceStudentController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\FeeTypeController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apply', [StudentController::class, 'showForm'])->name('apply');
Route::post('/apply/store', [StudentController::class, 'store'])->name('apply.store');
Route::get('/apply/success/{referenceNo}', [StudentController::class, 'success'])->name('apply.success');
Route::get('/apply/projects', [StudentController::class, 'getProjects'])->name('apply.projects');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admissions', [DashboardController::class, 'chartAdmissions'])->name('dashboard.admissions');
    Route::get('/dashboard/revenue', [DashboardController::class, 'chartRevenue'])->name('dashboard.revenue');

    Route::get('/projects/data', [ProjectController::class, 'data'])->name('projects.data');
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::get('/courses/data', [CourseController::class, 'data'])->name('courses.data');
    Route::get('/courses/by-project/{project}', [CourseController::class, 'byProject'])->name('courses.by-project');
    Route::resource('courses', CourseController::class)->except(['show']);
    Route::get('/batches/data', [BatchController::class, 'data'])->name('batches.data');
    Route::get('/batches/by-course/{course}', [BatchController::class, 'byCourse'])->name('batches.by-course');
    Route::get('/batches/{batch}/students/print', [BatchController::class, 'printStudents'])->name('batches.students.print');
    Route::resource('batches', BatchController::class)->except(['show']);
    Route::get('/students/data', [AdminStudentController::class, 'data'])->name('students.data');
    Route::get('/students/by-batch/{batch}', [AdminStudentController::class, 'byBatch'])->name('students.by-batch');
    // Full profile (show) route — constrain to numeric to avoid catching 'create' or 'edit' paths
    Route::get('/students/{student}/print', [AdminStudentController::class, 'print'])->whereNumber('student')->name('students.print');
    Route::get('/students/{student}', [AdminStudentController::class, 'show'])->whereNumber('student')->name('students.show');
    Route::resource('students', AdminStudentController::class)->except(['show']);
    Route::get('/employees/data', [EmployeeController::class, 'data'])->name('employees.data');
    Route::resource('employees', EmployeeController::class)->except(['show']);
    Route::get('/departments/data', [DepartmentController::class, 'data'])->name('departments.data');
    Route::resource('departments', DepartmentController::class)->except(['show']);
    Route::get('/designations/data', [DesignationController::class, 'data'])->name('designations.data');
    Route::resource('designations', DesignationController::class)->except(['show']);
    Route::get('/fee-types/data', [FeeTypeController::class, 'data'])->name('fee-types.data');
    Route::resource('fee-types', FeeTypeController::class)->except(['show']);
    Route::get('/invoices/data', [InvoiceController::class, 'data'])->name('invoices.data');
    Route::resource('invoices', InvoiceController::class)->except(['show']);
    Route::get('/payments/data', [PaymentController::class, 'data'])->name('payments.data');
    Route::resource('payments', PaymentController::class)->except(['show']);
    Route::get('/expenses/data', [ExpenseController::class, 'data'])->name('expenses.data');
    Route::resource('expenses', ExpenseController::class)->except(['show']);
    Route::get('/attendance/student', [AttendanceStudentController::class, 'index'])->name('attendance.student');
    Route::get('/attendance/employee', [AttendanceEmployeeController::class, 'index'])->name('attendance.employee');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/institute/edit', [InstituteController::class, 'edit'])->name('institute.edit');
    Route::patch('/institute/update', [InstituteController::class, 'update'])->name('institute.update');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::prefix('hr')->name('hr.')->group(function () {
        Route::get('attendance', [EmployeeAttendanceController::class, 'index'])->name('attendance.index');
        Route::get('attendance/create', [EmployeeAttendanceController::class, 'create'])->name('attendance.create');
        Route::post('attendance', [EmployeeAttendanceController::class, 'store'])->name('attendance.store');
        Route::get('attendance/{date}', [EmployeeAttendanceController::class, 'show'])->name('attendance.show');
    });

    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/', [StudentAttendanceController::class, 'index'])->name('index');
        Route::get('/batch/{batch}', [StudentAttendanceController::class, 'batchAttendance'])->name('batch');
        Route::post('/mark', [StudentAttendanceController::class, 'mark'])->name('mark');
        Route::get('/report/{batch}', [StudentAttendanceController::class, 'report'])->name('report');
    });

    Route::resource('exams', ExamController::class);
    Route::get('/exams/{exam}/marks', [ExamController::class, 'marks'])->name('exams.marks');
    Route::post('/exams/{exam}/marks', [ExamController::class, 'saveMarks'])->name('exams.marks.store');

    Route::resource('certificates', CertificateController::class);
});

require __DIR__.'/auth.php';
