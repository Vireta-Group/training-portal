@extends('admin.layouts.master')

@section('title', 'Batches - ' . config('app.name'))

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Select Project</label>
                <select id="projectSelect" class="form-select" onchange="onProjectChange()">
                    <option value="">-- Select a Project --</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Select Course</label>
                <select id="courseSelect" class="form-select" onchange="onCourseChange()">
                    <option value="">-- Select a Course --</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div id="batchSection" style="display:none;">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Batches</h5>
            <button onclick="openCreateForm()" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Add Batch
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="batchesTable" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Shift</th>
                            <th>Seats</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="noProjectMsg" class="text-center py-5 text-muted">
    <i class="fas fa-folder-open fa-3x mb-3"></i>
    <p class="fs-5">Please select a project and course to view batches</p>
</div>

<!-- Modal -->
<div class="modal fade" id="batchModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="modalBody"></div>
        </div>
    </div>
</div>

<!-- Student List Modal -->
<div class="modal fade" id="studentsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Students — <span id="studentsBatchName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="studentsLoading" class="text-center p-4"><div class="spinner-border"></div></div>
                <div id="studentsContent" style="display:none;">
                    <div class="d-flex justify-content-between mb-2">
                        <span id="studentsCount" class="badge bg-info fs-6"></span>
                        <a id="printStudentsBtn" href="#" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-print me-1"></i> Print</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th width="40">SL</th>
                                    <th>Name (EN)</th>
                                    <th>Name (BN)</th>
                                    <th>Father</th>
                                    <th>Mother</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody id="studentsTableBody"></tbody>
                        </table>
                    </div>
                </div>
                <div id="studentsEmpty" class="text-center py-4 text-muted" style="display:none;">
                    <i class="fas fa-user-slash fa-3x mb-2"></i>
                    <p>No students in this batch</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
var editUrl = '{{ route("admin.batches.edit", ":id") }}';
var coursesUrl = '{{ route("admin.courses.by-project", ":id") }}';
var studentsUrl = '{{ route("admin.students.by-batch", ":id") }}';
var printStudentsUrl = '{{ route("admin.batches.students.print", ":id") }}';
var selectedCourseId = '';

function onProjectChange() {
    var pid = $('#projectSelect').val();
    var $course = $('#courseSelect').html('<option value="">-- Select a Course --</option>');
    $('#batchSection').hide();
    $('#noProjectMsg').show();
    if (!pid) return;
    $.getJSON(coursesUrl.replace(':id', pid), function(data) {
        $.each(data, function(k, v) { $course.append('<option value="' + k + '">' + v + '</option>'); });
    });
}

function onCourseChange() {
    var cid = $('#courseSelect').val();
    if (cid) {
        $('#noProjectMsg').hide();
        $('#batchSection').show();
        selectedCourseId = cid;
        loadTable(cid);
    } else {
        $('#batchSection').hide();
        $('#noProjectMsg').show();
    }
}

function loadTable(courseId) {
    $.get('{{ route("admin.batches.data") }}', function(res) {
        var tbody = $('#batchesTable tbody').empty();
        $.each(res.data, function(i, b) {
            if (b.course_id != courseId) return;
            var statusBadge = b.status === 'active'
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-secondary">Inactive</span>';
            tbody.append('<tr>' +
                '<td>' + b.id + '</td>' +
                '<td>' + escHtml(b.name) + '</td>' +
                '<td>' + escHtml(b.shift || '') + '</td>' +
                '<td>' + (b.students_count || 0) + '/' + (b.seat_capacity || 0) + '</td>' +
                '<td>' + (b.start_date ? b.start_date.split('T')[0] : '-') + '</td>' +
                '<td>' + (b.end_date ? b.end_date.split('T')[0] : '-') + '</td>' +
                '<td>' + statusBadge + '</td>' +
                '<td><button onclick="openEditForm(' + b.id + ')" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></button> ' +
                '<button onclick="openStudents(' + b.id + ')" class="btn btn-sm btn-outline-info" title="Students"><i class="fas fa-users"></i></button></td>' +
            '</tr>');
        });
    });
}

function loadCoursesInForm(projectId) {
    var $course = $('#course_id');
    if (!projectId) { $course.html('<option value="">Select Course</option>'); return; }
    $course.html('<option value="">Loading...</option>');
    $.getJSON(coursesUrl.replace(':id', projectId), function(data) {
        var opts = '<option value="">Select Course</option>';
        var selected = $('#modalBody').data('selected-course') || '';
        $.each(data, function(k, v) {
            opts += '<option value="' + k + '"' + (selected == k ? ' selected' : '') + '>' + v + '</option>';
        });
        $course.html(opts);
    });
}

function openCreateForm() {
    $('#modalTitle').text('Add Batch');
    $('#modalBody').html('<div class="text-center p-4"><div class="spinner-border"></div></div>');
    $('#batchModal').modal('show');
    $.get('{{ route("admin.batches.create") }}', function(res) {
        $('#modalBody').html(res.html);
        $('#modalBody').data('selected-course', '');
    });
}

function openEditForm(id) {
    $('#modalTitle').text('Edit Batch');
    $('#modalBody').html('<div class="text-center p-4"><div class="spinner-border"></div></div>');
    $('#batchModal').modal('show');
    $.get(editUrl.replace(':id', id), function(res) {
        $('#modalBody').html(res.html);
        $('#modalBody').data('selected-course', res.batch?.course_id || '');
        loadCoursesInForm(res.batch?.project_id || $('#project_id').val());
    });
}

function openStudents(id) {
    $('#studentsLoading').show();
    $('#studentsContent').hide();
    $('#studentsEmpty').hide();
    $('#studentsModal').modal('show');
    $.getJSON(studentsUrl.replace(':id', id), function(res) {
        $('#studentsLoading').hide();
        $('#studentsBatchName').text(escHtml(res.batch.name));
        $('#printStudentsBtn').attr('href', printStudentsUrl.replace(':id', id));
        var tbody = $('#studentsTableBody').empty();
        if (!res.data || res.data.length === 0) {
            $('#studentsEmpty').show();
            $('#studentsContent').hide();
            return;
        }
        $('#studentsContent').show();
        $('#studentsCount').text(res.data.length + ' student(s)');
        $.each(res.data, function(i, s) {
            var address = [s.present_village, s.present_road, s.present_po, s.present_upazila, s.present_district].filter(Boolean).join(', ');
            tbody.append('<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + escHtml(s.name_en) + '</td>' +
                '<td>' + escHtml(s.name_bn || '') + '</td>' +
                '<td>' + escHtml(s.father_name_en || '') + '</td>' +
                '<td>' + escHtml(s.mother_name_en || '') + '</td>' +
                '<td>' + escHtml(s.contact || '') + '</td>' +
                '<td>' + escHtml(address || '') + '</td>' +
            '</tr>');
        });
    });
}

$(document).on('change', '#project_id', function() {
    loadCoursesInForm($(this).val());
});

$(document).on('submit', '#crudForm', function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var method = form.find('input[name="_method"]').val() || 'POST';
    $.ajax({
        url: url,
        method: method,
        data: form.serialize(),
        success: function() {
            $('#batchModal').modal('hide');
            loadTable(selectedCourseId);
        },
        error: function(xhr) {
            var errors = xhr.responseJSON?.errors;
            if (errors) {
                var msg = '';
                $.each(errors, function(k, v) { msg += v[0] + '\n'; });
                alert(msg);
            }
        }
    });
});

function escHtml(str) {
    if (!str) return '';
    return $('<span>').text(str).html();
}
</script>
@endpush
