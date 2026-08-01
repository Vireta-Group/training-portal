@extends('admin.layouts.admin')
@section('title', 'Invoices')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Invoices</h1>
        <button onclick="openCreateForm()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">+ Add Invoice</button>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table id="dataTable" class="w-full">
            <thead><tr><th>ID</th><th>Invoice No</th><th>Student</th><th>Batch</th><th>Total</th><th>Paid</th><th>Due</th><th>Due Date</th><th>Status</th><th>Actions</th></tr></thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
var table;
$(function() {
    table = $('#dataTable').DataTable({
        processing: true, ajax: '{{ route("admin.invoices.data") }}',
        columns: [
            { data: 'id' },
            { data: 'invoice_no' },
            { data: 'student.name_en', defaultContent: '' },
            { data: 'batch.name', defaultContent: '' },
            { data: 'total_amount', render: function(d) { return d + ' Tk'; } },
            { data: 'paid_amount', render: function(d) { return d + ' Tk'; } },
            { data: 'due_amount', render: function(d) { return d + ' Tk'; } },
            { data: 'due_date' },
            { data: 'status', render: function(d) {
                var colors = { paid: 'bg-green-100 text-green-700', partial: 'bg-yellow-100 text-yellow-700', due: 'bg-red-100 text-red-700', cancelled: 'bg-gray-100 text-gray-600' };
                return '<span class="px-2 py-1 text-xs rounded-full ' + (colors[d] || '') + '">' + d + '</span>';
            }},
            { data: null, render: function(row) { return '<button onclick="openEditForm(' + row.id + ')" class="text-indigo-600 hover:text-indigo-800 text-sm mr-2">Edit</button><button onclick="deleteRecord(' + row.id + ')" class="text-red-600 hover:text-red-800 text-sm">Delete</button>'; } }
        ]
    });
});
function openCreateForm() { $.get('{{ route("admin.invoices.create") }}', function(res) { openModal(res.html); }); }
function openEditForm(id) { $.get('/admin/invoices/' + id + '/edit', function(res) { openModal(res.html); }); }
function deleteRecord(id) { confirmDelete('/admin/invoices/' + id, function() { table.ajax.reload(); }); }
$(document).on('submit', '#crudForm', function(e) { e.preventDefault(); submitForm($(this), function() { table.ajax.reload(); }); });
</script>
@endpush
