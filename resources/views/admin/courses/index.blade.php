@extends('admin.layouts.master')

@section('title', 'Courses - ' . config('app.name'))

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Select Project</label>
                <select id="projectSelect" class="form-select" onchange="onProjectChange()">
                    <option value="">-- Select a Project --</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div id="courseSection" style="display:none;">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Courses</h5>
            <button onclick="openCreateForm()" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Add Course
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="coursesTable" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Name (Bangla)</th>
                            <th>Duration</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th width="120">Actions</th>
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
    <p class="fs-5">Please select a project to view courses</p>
</div>

<!-- Modal -->
<div class="modal fade" id="courseModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="modalBody"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
var editUrl = '{{ route("admin.courses.edit", ":id") }}';

function onProjectChange() {
    var pid = $('#projectSelect').val();
    if (pid) {
        $('#noProjectMsg').hide();
        $('#courseSection').show();
        loadTable(pid);
    } else {
        $('#courseSection').hide();
        $('#noProjectMsg').show();
    }
}

function loadTable(projectId) {
    $.get('{{ route("admin.courses.data") }}', function(res) {
        var tbody = $('#coursesTable tbody').empty();
        $.each(res.data, function(i, c) {
            if (c.project_id != projectId) return;
            var statusBadge = c.status === 'active'
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-secondary">Inactive</span>';
            tbody.append('<tr>' +
                '<td>' + c.id + '</td>' +
                '<td>' + escHtml(c.name) + '</td>' +
                '<td>' + escHtml(c.name_bn || '') + '</td>' +
                '<td>' + c.duration + ' months</td>' +
                '<td>' + (c.fee ? parseFloat(c.fee).toFixed(2) + ' Tk' : '') + '</td>' +
                '<td>' + statusBadge + '</td>' +
                '<td>' +
                    '<button onclick="openEditForm(' + c.id + ')" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></button>' +
                '</td>' +
            '</tr>');
        });
    });
}

function openCreateForm() {
    $('#modalTitle').text('Add Course');
    $('#modalBody').html('<div class="text-center p-4"><div class="spinner-border"></div></div>');
    $('#courseModal').modal('show');
    $.get('{{ route("admin.courses.create") }}', function(res) {
        $('#modalBody').html(res.html);
    });
}

function openEditForm(id) {
    $('#modalTitle').text('Edit Course');
    $('#modalBody').html('<div class="text-center p-4"><div class="spinner-border"></div></div>');
    $('#courseModal').modal('show');
    $.get(editUrl.replace(':id', id), function(res) {
        $('#modalBody').html(res.html);
    });
}

$(document).on('submit', '#crudForm', function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var method = form.find('input[name="_method"]').val() || 'POST';
    $.ajax({
        url: url,
        method: method,
        data: form.serialize(),
        success: function(res) {
            $('#courseModal').modal('hide');
            loadTable($('#projectSelect').val());
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
