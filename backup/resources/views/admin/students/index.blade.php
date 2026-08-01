@extends('admin.layouts.admin')
@section('title', 'Students')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Students</h1>
        <button onclick="openCreateForm()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">+ Add Student</button>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table id="dataTable" class="w-full">
            <thead><tr><th>ID</th><th>Name</th><th>Contact</th><th>Project</th><th>Course</th><th>Batch</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
var table;
$(function() {
    table = $('#dataTable').DataTable({
        processing: true, ajax: '{{ route("admin.students.data") }}',
        columns: [
            { data: 'id' },
            { data: 'name_en' },
            { data: 'contact' },
            { data: 'project.name', defaultContent: '' },
            { data: 'course.name', defaultContent: '' },
            { data: 'batch.name', defaultContent: '' },
            { data: 'status', render: function(d) {
                var colors = { applied: 'bg-yellow-100 text-yellow-700', admitted: 'bg-green-100 text-green-700', active: 'bg-blue-100 text-blue-700', inactive: 'bg-gray-100 text-gray-600', graduated: 'bg-purple-100 text-purple-700' };
                return '<span class="px-2 py-1 text-xs rounded-full ' + (colors[d] || 'bg-gray-100 text-gray-600') + '">' + d + '</span>';
            }},
            { data: 'created_at', render: function(d) { return d ? new Date(d).toLocaleDateString() : ''; } },
            { data: null, render: function(row) { return '<button onclick="openEditForm(' + row.id + ')" class="text-indigo-600 hover:text-indigo-800 text-sm mr-2">Edit</button><button onclick="deleteRecord(' + row.id + ')" class="text-red-600 hover:text-red-800 text-sm">Delete</button>'; } }
        ]
    });
});
function openCreateForm() { $.get('{{ route("admin.students.create") }}', function(res) { openModal(res.html); }); }
function openEditForm(id) { $.get('/admin/students/' + id + '/edit', function(res) { openModal(res.html); }); }
function deleteRecord(id) { confirmDelete('/admin/students/' + id, function() { table.ajax.reload(); }); }
$(document).on('submit', '#crudForm', function(e) { e.preventDefault(); submitForm($(this), function() { table.ajax.reload(); }); });
</script>
@endpush
