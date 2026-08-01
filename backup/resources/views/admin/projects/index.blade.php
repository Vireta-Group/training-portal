@extends('admin.layouts.admin')
@section('title', 'Projects')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Projects</h1>
        <button onclick="openCreateForm()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">+ Add Project</button>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table id="dataTable" class="w-full">
            <thead><tr>
                <th>ID</th><th>Name</th><th>Name (Bangla)</th><th>Code</th><th>Status</th><th>Actions</th>
            </tr></thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
var table;
$(function() {
    table = $('#dataTable').DataTable({
        processing: true, serverSide: false, ajax: '{{ route("admin.projects.data") }}',
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'name_bn' },
            { data: 'code' },
            { data: 'status', render: function(d) { return '<span class="px-2 py-1 text-xs rounded-full ' + (d === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600') + '">' + d + '</span>'; } },
            { data: null, render: function(row) {
                return '<button onclick="openEditForm(' + row.id + ')" class="text-indigo-600 hover:text-indigo-800 text-sm mr-2">Edit</button>' +
                       '<button onclick="deleteRecord(' + row.id + ')" class="text-red-600 hover:text-red-800 text-sm">Delete</button>';
            }}
        ]
    });
});

function openCreateForm() {
    $.get('{{ route("admin.projects.create") }}', function(res) {
        openModal(res.html);
    });
}

function openEditForm(id) {
    $.get('/admin/projects/' + id + '/edit', function(res) {
        openModal(res.html);
    });
}

function deleteRecord(id) {
    confirmDelete('/admin/projects/' + id, function() { table.ajax.reload(); });
}

$(document).on('submit', '#crudForm', function(e) {
    e.preventDefault();
    submitForm($(this), function() { table.ajax.reload(); });
});
</script>
@endpush
