@extends('admin.layouts.master')

@section('title', 'Projects - ' . config('app.name'))

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Projects</h5>
        <button onclick="openCreateForm()" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Add Project
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="projectsTable" class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Name (Bangla)</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="projectModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="modalBody"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
var editUrl = '{{ route("admin.projects.edit", ":id") }}';

function loadTable() {
    $.get('{{ route("admin.projects.data") }}', function(res) {
        var tbody = $('#projectsTable tbody').empty();
        $.each(res.data, function(i, p) {
            var statusBadge = p.status === 'active'
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-secondary">Inactive</span>';
            tbody.append('<tr>' +
                '<td>' + p.id + '</td>' +
                '<td>' + escHtml(p.name) + '</td>' +
                '<td>' + escHtml(p.name_bn || '') + '</td>' +
                '<td>' + escHtml(p.code || '') + '</td>' +
                '<td>' + statusBadge + '</td>' +
                '<td>' +
                    '<button onclick="openEditForm(' + p.id + ')" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></button>' +
                '</td>' +
            '</tr>');
        });
    });
}

function openCreateForm() {
    $('#modalTitle').text('Add Project');
    $('#modalBody').html('<div class="text-center p-4"><div class="spinner-border"></div></div>');
    $('#projectModal').modal('show');
    $.get('{{ route("admin.projects.create") }}', function(res) {
        $('#modalBody').html(res.html);
    });
}

function openEditForm(id) {
    $('#modalTitle').text('Edit Project');
    $('#modalBody').html('<div class="text-center p-4"><div class="spinner-border"></div></div>');
    $('#projectModal').modal('show');
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
            $('#projectModal').modal('hide');
            loadTable();
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

$(function() {
    loadTable();
});
</script>
@endpush
