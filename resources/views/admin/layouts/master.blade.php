<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <nav class="bg-dark text-white" style="width: 250px; min-height: 100vh; position: fixed; top: 0; left: 0; overflow-y: auto;">
            <div class="p-3 border-bottom border-secondary">
                <h5 class="mb-0">{{ config('app.name') }}</h5>
                <small class="text-secondary">Admin Panel</small>
            </div>
            <div class="p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <small class="text-secondary text-uppercase px-3">Academic</small>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.projects.index') }}" class="nav-link text-white {{ request()->routeIs('admin.projects.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-project-diagram me-2"></i> Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.courses.index') }}" class="nav-link text-white {{ request()->routeIs('admin.courses.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-book me-2"></i> Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.batches.index') }}" class="nav-link text-white {{ request()->routeIs('admin.batches.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-layer-group me-2"></i> Batches
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.students.index') }}" class="nav-link text-white {{ request()->routeIs('admin.students.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-user-graduate me-2"></i> Students
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <small class="text-secondary text-uppercase px-3">HR</small>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.employees.index') }}" class="nav-link text-white {{ request()->routeIs('admin.employees.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-users me-2"></i> Employees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.departments.index') }}" class="nav-link text-white {{ request()->routeIs('admin.departments.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-building me-2"></i> Departments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.designations.index') }}" class="nav-link text-white {{ request()->routeIs('admin.designations.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-id-badge me-2"></i> Designations
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <small class="text-secondary text-uppercase px-3">Finance</small>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.fee-types.index') }}" class="nav-link text-white {{ request()->routeIs('admin.fee-types.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-tags me-2"></i> Fee Types
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.invoices.index') }}" class="nav-link text-white {{ request()->routeIs('admin.invoices.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-file-invoice me-2"></i> Invoices
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.payments.index') }}" class="nav-link text-white {{ request()->routeIs('admin.payments.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-credit-card me-2"></i> Payments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.expenses.index') }}" class="nav-link text-white {{ request()->routeIs('admin.expenses.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-money-bill-wave me-2"></i> Expenses
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <small class="text-secondary text-uppercase px-3">Attendance</small>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.attendance.student') }}" class="nav-link text-white {{ request()->routeIs('admin.attendance.student*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-calendar-check me-2"></i> Student Attendance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.attendance.employee') }}" class="nav-link text-white {{ request()->routeIs('admin.attendance.employee*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-calendar-alt me-2"></i> Employee Attendance
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <small class="text-secondary text-uppercase px-3">Other</small>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('exams.index') }}" class="nav-link text-white {{ request()->routeIs('exams.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-pencil-alt me-2"></i> Exams
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('certificates.index') }}" class="nav-link text-white {{ request()->routeIs('certificates.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-certificate me-2"></i> Certificates
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('institute.edit') }}" class="nav-link text-white {{ request()->routeIs('institute.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-university me-2"></i> Institute
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('settings.edit') }}" class="nav-link text-white {{ request()->routeIs('settings.*') ? 'active fw-bold' : '' }}">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div style="margin-left: 250px; flex: 1;">
            <nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-4">
                <div class="container-fluid">
                    <span class="navbar-text ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </span>
                </div>
            </nav>

            <main class="p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
    $(document).on('focus', '.datepicker', function() {
        $(this).datepicker({ format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true });
    });
    </script>
    @stack('scripts')
</body>
</html>
