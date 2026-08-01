<div class="p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $invoice ? 'Edit Invoice' : 'Add Invoice' }}</h3>
    <form id="crudForm" action="{{ $invoice ? route('admin.invoices.update', $invoice) : route('admin.invoices.store') }}" method="POST">
        @csrf @if($invoice) @method('PUT') @endif
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice No</label>
                <input type="text" name="invoice_no" value="{{ $invoice->invoice_no ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
                <select name="student_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Select</option>
                    @foreach($students as $id => $name)
                        <option value="{{ $id }}" {{ ($invoice->student_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                <select name="batch_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Select</option>
                    @foreach($batches as $id => $name)
                        <option value="{{ $id }}" {{ ($invoice->batch_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="due" {{ ($invoice->status ?? '') === 'due' ? 'selected' : '' }}>Due</option>
                    <option value="partial" {{ ($invoice->status ?? '') === 'partial' ? 'selected' : '' }}>Partial</option>
                    <option value="paid" {{ ($invoice->status ?? '') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="cancelled" {{ ($invoice->status ?? '') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Total Amount</label>
                <input type="number" step="0.01" name="total_amount" value="{{ $invoice->total_amount ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Paid Amount</label>
                <input type="number" step="0.01" name="paid_amount" value="{{ $invoice->paid_amount ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                <input type="date" name="due_date" value="{{ $invoice->due_date ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                <textarea name="remarks" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">{{ $invoice->remarks ?? '' }}</textarea>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Save</button>
        </div>
    </form>
</div>
