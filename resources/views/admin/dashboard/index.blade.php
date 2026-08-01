@extends('admin.layouts.master')

@section('title', 'Dashboard - ' . config('app.name'))

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Students</h6>
                            <h2 class="mb-0">{{ $stats['students'] }}</h2>
                        </div>
                        <i class="fas fa-user-graduate fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Active Courses</h6>
                            <h2 class="mb-0">{{ $stats['courses'] }}</h2>
                        </div>
                        <i class="fas fa-book fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Revenue</h6>
                            <h2 class="mb-0">{{ number_format($stats['revenue'], 2) }}</h2>
                        </div>
                        <i class="fas fa-dollar-sign fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Active Projects</h6>
                            <h2 class="mb-0">{{ $stats['projects'] }}</h2>
                        </div>
                        <i class="fas fa-project-diagram fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Admissions by Status</h5>
                </div>
                <div class="card-body">
                    <canvas id="admissionsChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Revenue</h5>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(function() {
    $.get('{{ route("admin.dashboard.admissions") }}', function(res) {
        new Chart(document.getElementById('admissionsChart'), {
            type: 'pie',
            data: {
                labels: res.labels,
                datasets: [{
                    data: res.values,
                    backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6c757d']
                }]
            }
        });
    });

    $.get('{{ route("admin.dashboard.revenue") }}', function(res) {
        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: res.labels,
                datasets: [{
                    label: 'Revenue',
                    data: res.values,
                    borderColor: '#0d6efd',
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
});
</script>
@endpush
