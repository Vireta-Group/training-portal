@extends('admin.layouts.master')

@section('title', 'Edit Student - ' . config('app.name'))

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Student</h5>
        <a href="{{ route('admin.students.show', $student) }}" class="btn btn-secondary btn-sm">Back to Profile</a>
    </div>
    <div class="card-body">
        {{-- Reuse the form partial (it contains the <form> element) --}}
        @include('admin.students.form', ['student' => $student, 'projects' => $projects])
    </div>
</div>
@endsection

@push('scripts')
<script>
var coursesUrl = '{{ route("admin.courses.by-project", ":id") }}';
var batchesUrl = '{{ route("admin.batches.by-course", ":id") }}';

$(function() {
    var $project = $('#s_project_id');
    var $course = $('#s_course_id');
    var $batch = $('#s_batch_id');

    function populateCourses(projectId, selected) {
        $course.html('<option value="">Loading...</option>');
        if (!projectId) {
            $course.html('<option value="">Select Course</option>');
            $('#courseWrapper').hide();
            $('#batchWrapper').hide();
            return;
        }
        $('#courseWrapper').show();
        $.getJSON(coursesUrl.replace(':id', projectId), function(data) {
            var opts = '<option value="">Select Course</option>';
            $.each(data, function(k, v) { opts += '<option value="' + k + '"' + (selected == k ? ' selected' : '') + '>' + v + '</option>'; });
            $course.html(opts);
        });
    }

    function populateBatches(courseId, selected) {
        $batch.html('<option value="">Loading...</option>');
        if (!courseId) {
            $batch.html('<option value="">Select Batch</option>');
            $('#batchWrapper').hide();
            return;
        }
        $('#batchWrapper').show();
        $.getJSON(batchesUrl.replace(':id', courseId), function(data) {
            var opts = '<option value="">Select Batch</option>';
            $.each(data, function(k, v) { opts += '<option value="' + k + '"' + (selected == k ? ' selected' : '') + '>' + v + '</option>'; });
            $batch.html(opts);
        });
    }

    $project.on('change', function() {
        var pid = $(this).val();
        populateCourses(pid, '');
        $batch.html('<option value="">Select Batch</option>');
        $('#batchWrapper').hide();
    });

    $course.on('change', function() {
        var cid = $(this).val();
        populateBatches(cid, '');
    });

    // If editing existing student, preload course & batch selects
    @if(!empty($student->project_id))
        populateCourses('{{ $student->project_id }}', '{{ $student->course_id ?? '' }}');
        // small delay to allow courses to populate before loading batches
        setTimeout(function() {
            populateBatches('{{ $student->course_id ?? '' }}', '{{ $student->batch_id ?? '' }}');
        }, 300);
    @endif
});
</script>
@endpush
