@extends('admin.layouts.admin')
@section('title', 'Payments')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Payments</h1>
        <button onclick="openCreateForm()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">+ Add Payment</button>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table id="dataTable" class="w-full">
            <thead><tr><th>ID</th><th>Student</th><th>Invoice</th><th>Fee Type</th><th>Amount</th><th>Date</th><th>Method</th><th>Reference</th><th>Actions</th></tr></thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
var table;
$(function() {
    table = $('#dataTable').DataTable({
        processing: true, ajax: '{{ route("admin.payments.data") }}',
        columns: [
            { data: 'id' },
            { data: 'student.name_en', defaultContent: '' },
            { data: 'invoice.invoice_no', defaultContent: '' },
            { data: 'fee_type.name', defaultContent: '' },
            { data: 'amount', render: function(d) { return d + ' Tk'; } },
            { data: 'payment_date' },
            { data: 'payment_method' },
            { data: 'reference_no' },
            { data: null, render: function(row) { return '<button onclick="openEditForm(' + row.id + ')" class="text-indigo-600 hover:text-indigo-800 text-sm mr-2">Edit</button><button onclick="deleteRecord(' + row.id + ')" class="text-red-600 hover:text-red-800 text-sm">Delete</button>'; } }
        ]
    });
});
function openCreateForm() { $.get('{{ route("admin.payments.create") }}', function(res) { openModal(res.html); }); }
function openEditForm(id) { $.get('/admin/payments/' + id + '/edit', function(res) { openModal(res.html); }); }
function deleteRecord(id) { confirmDelete('/admin/payments/' + id, function() { table.ajax.reload(); }); }
$(document).on('submit', '#crudForm', function(e) { e.preventDefault(); submitForm($(this), function() { table.ajax.reload(); }); });
</script>
@endpush
