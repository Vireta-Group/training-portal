<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('public/css/tailwind-build.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('public/css/admin.css') }}">
</head>
<body class="bg-gray-50 min-h-screen">

<div class="flex h-screen overflow-hidden">
    {{-- Sidebar --}}
    <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden lg:block overflow-y-auto">
        <div class="p-4 border-b border-gray-200">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">TP</div>
                <span class="font-bold text-gray-800">{{ config('app.name') }}</span>
            </a>
        </div>
        <nav class="p-3 space-y-1">
            <x-admin.nav-item :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="chart-bar">Dashboard</x-admin.nav-item>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pt-4 pb-1">Academics</div>
            <x-admin.nav-item :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')" icon="folder">Projects</x-admin.nav-item>
            <x-admin.nav-item :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.*')" icon="academic-cap">Courses</x-admin.nav-item>
            <x-admin.nav-item :href="route('admin.batches.index')" :active="request()->routeIs('admin.batches.*')" icon="users">Batches</x-admin.nav-item>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pt-4 pb-1">Admissions</div>
            <x-admin.nav-item :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')" icon="user-group">Students</x-admin.nav-item>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pt-4 pb-1">HR</div>
            <x-admin.nav-item :href="route('admin.employees.index')" :active="request()->routeIs('admin.employees.*')" icon="user">Employees</x-admin.nav-item>
            <x-admin.nav-item :href="route('admin.departments.index')" :active="request()->routeIs('admin.departments.*')" icon="building">Departments</x-admin.nav-item>
            <x-admin.nav-item :href="route('admin.designations.index')" :active="request()->routeIs('admin.designations.*')" icon="briefcase">Designations</x-admin.nav-item>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pt-4 pb-1">Finance</div>
            <x-admin.nav-item :href="route('admin.invoices.index')" :active="request()->routeIs('admin.invoices.*')" icon="document">Invoices</x-admin.nav-item>
            <x-admin.nav-item :href="route('admin.payments.index')" :active="request()->routeIs('admin.payments.*')" icon="currency-dollar">Payments</x-admin.nav-item>
            <x-admin.nav-item :href="route('admin.expenses.index')" :active="request()->routeIs('admin.expenses.*')" icon="banknotes">Expenses</x-admin.nav-item>
            <x-admin.nav-item :href="route('admin.fee-types.index')" :active="request()->routeIs('admin.fee-types.*')" icon="tag">Fee Types</x-admin.nav-item>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pt-4 pb-1">Attendance</div>
            <x-admin.nav-item :href="route('admin.attendance.student')" :active="request()->routeIs('admin.attendance.student')" icon="clipboard">Student Attendance</x-admin.nav-item>
            <x-admin.nav-item :href="route('admin.attendance.employee')" :active="request()->routeIs('admin.attendance.employee')" icon="clipboard-list">Employee Attendance</x-admin.nav-item>

            <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 pt-4 pb-1">Settings</div>
            <x-admin.nav-item :href="route('institute.edit')" icon="office-building">Institute</x-admin.nav-item>
            <x-admin.nav-item :href="route('settings.edit')" icon="cog">System</x-admin.nav-item>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Top Navbar --}}
        <header class="bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
            <button id="sidebarToggle" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100" type="button">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="flex items-center gap-3 ml-auto">
                <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-500 hover:text-red-600 transition">Logout</button>
                </form>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

{{-- Mobile sidebar overlay --}}
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="{{ asset('public/js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
