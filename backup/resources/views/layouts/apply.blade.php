<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Registration — {{ App\Models\CompanySetting::getSettings()->company_name ?? 'TrainingPro' }}</title>
    <link rel="stylesheet" href="{{ asset('public/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/cropper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/tailwind-build.css') }}" />
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('public/js/cropper.min.js') }}"></script>
    <script src="{{ asset('public/js/alpine.min.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.datepicker').forEach(el => {
                if (!el._flatpickr) flatpickr(el, { dateFormat: 'Y-m-d', allowInput: true });
            });
            document.querySelectorAll('.timepicker').forEach(el => {
                if (!el._flatpickr) flatpickr(el, { enableTime: true, noCalendar: true, dateFormat: 'H:i', allowInput: true });
            });
            document.querySelectorAll('.datetimepicker').forEach(el => {
                if (!el._flatpickr) flatpickr(el, { enableTime: true, dateFormat: 'Y-m-d H:i', allowInput: true });
            });
            document.querySelectorAll('.monthpicker').forEach(el => {
                if (!el._flatpickr) flatpickr(el, { dateFormat: 'Y-m', altInput: true, altFormat: 'F Y', allowInput: true });
            });
        });
    </script>
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Student Registration</h1>
            <p class="text-gray-500 mt-1">{{ App\Models\CompanySetting::getSettings()->tagline ?? 'Apply for admission' }}</p>
        </div>
        @yield('content')
    </div>
</body>
</html>