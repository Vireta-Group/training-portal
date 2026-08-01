@extends('admin.layouts.master')

@section('title', 'Students - ' . config('app.name'))

@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs mb-3" id="studentTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="tab-applied" data-status="applied" type="button">Applied</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab-admitted" data-status="admitted" type="button">Admitted</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab-inactive" data-status="inactive" type="button">Inactive</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab-completed" data-status="graduated" type="button">Completed</button>
    </li>
</ul>

<!-- Filters (only for Admitted and Completed) -->
<div class="card mb-4" id="filterCard" style="display:none;">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Select Project</label>
                <select id="projectSelect" class="form-select" onchange="onProjectChange()">
                    <option value="">-- Select a Project --</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Select Course</label>
                <select id="courseSelect" class="form-select" onchange="onCourseChange()">
                    <option value="">-- Select a Course --</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Select Batch</label>
                <select id="batchSelect" class="form-select" onchange="onBatchChange()">
                    <option value="">-- Select a Batch --</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Students Table -->
<div id="studentSection">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Students</h5>
            <button onclick="openCreateForm()" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Add Student
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="studentsTable" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Batch</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="modalBody"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
var editUrl = '{{ route("admin.students.edit", ":id") }}';
var viewUrl = '{{ route("admin.students.show", ":id") }}';
var coursesUrl = '{{ route("admin.courses.by-project", ":id") }}';
var batchesUrl = '{{ route("admin.batches.by-course", ":id") }}';
var selectedBatchId = '';
var activeStatus = 'applied'; // default tab

// Tab switching logic
$('#studentTabs button').on('click', function() {
    $('#studentTabs .nav-link').removeClass('active');
    $(this).addClass('active');
    activeStatus = $(this).data('status');
    onTabChange(activeStatus);
});

function onTabChange(status) {
    // Show filters only for admitted and graduated (Completed)
    if (status === 'admitted' || status === 'graduated') {
        $('#filterCard').show();
        // require project/course/batch selection before loading table
        var bid = $('#batchSelect').val();
        if (bid) {
            selectedBatchId = bid;
            loadTable(bid, status);
            $('#studentSection').show();
            $('#noProjectMsg').hide();
        } else {
            $('#studentSection').hide();
            $('#noProjectMsg').show();
            $('#noProjectMsg').text('Please select a project, course and batch to view ' + (status === 'admitted' ? 'admitted' : 'completed') + ' students');
        }
    } else {
        // Applied and Inactive: hide filters and list by status globally
        $('#filterCard').hide();
        $('#noProjectMsg').hide();
        $('#studentSection').show();
        loadTable(null, status);
    }
}

function onProjectChange() {
    var pid = $('#projectSelect').val();
    $('#courseSelect').html('<option value="">-- Select a Course --</option>');
    $('#batchSelect').html('<option value="">-- Select a Batch --</option>');
    $('#studentSection').hide();
    $('#noProjectMsg').show();
    if (!pid) return;
    $.getJSON(coursesUrl.replace(':id', pid), function(data) {
        var $c = $('#courseSelect');
        $.each(data, function(k, v) { $c.append('<option value="' + k + '">' + v + '</option>'); });
    });
}

function onCourseChange() {
    var cid = $('#courseSelect').val();
    $('#batchSelect').html('<option value="">-- Select a Batch --</option>');
    $('#studentSection').hide();
    $('#noProjectMsg').show();
    if (!cid) return;
    $.getJSON(batchesUrl.replace(':id', cid), function(data) {
        var $b = $('#batchSelect');
        $.each(data, function(k, v) { $b.append('<option value="' + k + '">' + v + '</option>'); });
    });
}

function onBatchChange() {
    var bid = $('#batchSelect').val();
    if (bid) {
        $('#noProjectMsg').hide();
        $('#studentSection').show();
        selectedBatchId = bid;
        loadTable(bid, activeStatus);
    } else {
        $('#studentSection').hide();
        $('#noProjectMsg').show();
    }
}

/**
 * Format a date string into "04 Jun 2026" style
 */
function formatDate(dateStr) {
    if (!dateStr) return '-';
    var d = new Date(dateStr);
    if (isNaN(d.getTime())) return '-';
    var day = ('0' + d.getDate()).slice(-2);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var mon = months[d.getMonth()];
    var year = d.getFullYear();
    return day + ' ' + mon + ' ' + year;
}

/**
 * Load table client-side from admin.students.data endpoint and filter locally.
 *
 * @param batchId optional batch id to filter by (only used for admitted/graduated)
 * @param statusRequired student status to show
 */
function loadTable(batchId, statusRequired) {
    $.get('{{ route("admin.students.data") }}', function(res) {
        var tbody = $('#studentsTable tbody').empty();
        var statusColors = { applied: 'bg-warning', admitted: 'bg-info', active: 'bg-success', inactive: 'bg-secondary', graduated: 'bg-primary' };
        $.each(res.data, function(i, s) {
            // Filter by status first
            if (statusRequired && s.status !== statusRequired) return;
            // If admitted or completed (graduated) require matching batch when batchId provided
            if ((statusRequired === 'admitted' || statusRequired === 'graduated') && batchId) {
                if (s.batch_id != batchId) return;
            }
            var badge = statusColors[s.status] || 'bg-secondary';
            var date = s.created_at ? formatDate(s.created_at) : '-';
            tbody.append('<tr>' +
                '<td>' + s.id + '</td>' +
                // Name column: Name with Contact underneath
                '<td>' + escHtml(s.name_en) + '<br><small class="text-muted">' + escHtml(s.contact || '') + '</small>' +
                '</td>' +
                // Batch column: show Project name above Batch name
                '<td>' + (s.project?.name ? '<small class="text-muted">' + escHtml(s.project.name) + '</small><br>' : '') + escHtml(s.batch?.name || '') + '</td>' +
                '<td><span class="badge ' + badge + '">' + s.status + '</span></td>' +
                '<td>' + date + '</td>' +
                '<td><a href="' + viewUrl.replace(':id', s.id) + '" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="View"><i class="fas fa-eye"></i></a><button onclick="openEditForm(' + s.id + ')" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></button></td>' +
            '</tr>');
        });
    });
}

// --- Modal form progressive reveal ---
function revealForm() {
    var pid = $('#s_project_id').val();
    var cid = $('#s_course_id').val();
    var bid = $('#s_batch_id').val();

    if (pid && cid && bid) {
        $('#fullFormFields').show();
        $('#formFooter').show();
    } else {
        $('#fullFormFields').hide();
        $('#formFooter').hide();
    }
}

function loadSCourses(projectId, selected) {
    var $c = $('#s_course_id');
    if (!projectId) {
        $c.html('<option value="">Select Course</option>');
        $('#courseWrapper').hide();
        $('#batchWrapper').hide();
        revealForm();
        return;
    }
    $('#courseWrapper').show();
    $c.html('<option value="">Loading...</option>');
    $.getJSON(coursesUrl.replace(':id', projectId), function(data) {
        var opts = '<option value="">Select Course</option>';
        $.each(data, function(k, v) {
            opts += '<option value="' + k + '"' + (selected == k ? ' selected' : '') + '>' + v + '</option>';
        });
        $c.html(opts);
        revealForm();
    });
}

function loadSBatches(courseId, selected) {
    var $b = $('#s_batch_id');
    if (!courseId) {
        $b.html('<option value="">Select Batch</option>');
        $('#batchWrapper').hide();
        revealForm();
        return;
    }
    $('#batchWrapper').show();
    $b.html('<option value="">Loading...</option>');
    $.getJSON(batchesUrl.replace(':id', courseId), function(data) {
        var opts = '<option value="">Select Batch</option>';
        $.each(data, function(k, v) {
            opts += '<option value="' + k + '"' + (selected == k ? ' selected' : '') + '>' + v + '</option>';
        });
        $b.html(opts);
        revealForm();
    });
}

function openCreateForm() {
    $('#modalTitle').text('Add Student');
    $('#modalBody').html('<div class="text-center p-4"><div class="spinner-border"></div></div>');
    $('#studentModal').modal('show');
    $.get('{{ route("admin.students.create") }}', function(res) {
        $('#modalBody').html(res.html);
    });
}

function openEditForm(id) {
    $('#modalTitle').text('Edit Student');
    $('#modalBody').html('<div class="text-center p-4"><div class="spinner-border"></div></div>');
    $('#studentModal').modal('show');
    $.get(editUrl.replace(':id', id), function(res) {
        $('#modalBody').html(res.html);
        var st = res.student;
        if (st) {
            loadSCourses(st.project_id, st.course_id);
            setTimeout(function() { loadSBatches(st.course_id, st.batch_id); }, 300);
        }
    });
}

$(document).on('change', '#s_project_id', function() {
    loadSCourses($(this).val(), '');
    $('#s_batch_id').html('<option value="">Select Batch</option>');
    $('#batchWrapper').hide();
    revealForm();
});

$(document).on('change', '#s_course_id', function() {
    loadSBatches($(this).val(), '');
    revealForm();
});

$(document).on('change', '#s_batch_id', function() {
    revealForm();
});

$(document).on('submit', '#crudForm', function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: new FormData(form[0]),
        processData: false,
        contentType: false,
        success: function() {
            $('#studentModal').modal('hide');
            loadTable(selectedBatchId, activeStatus);
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

// Initialize view for default tab
$(function() {
    onTabChange(activeStatus);
});
</script>
@endpush
