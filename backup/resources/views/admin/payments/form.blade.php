<div class="p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $payment ? 'Edit Payment' : 'Add Payment' }}</h3>
    <form id="crudForm" action="{{ $payment ? route('admin.payments.update', $payment) : route('admin.payments.store') }}" method="POST">
        @csrf @if($payment) @method('PUT') @endif
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
                <select name="student_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Select</option>
                    @foreach($students as $id => $name)
                        <option value="{{ $id }}" {{ ($payment->student_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice</label>
                <select name="invoice_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select</option>
                    @foreach($invoices as $id => $no)
                        <option value="{{ $id }}" {{ ($payment->invoice_id ?? '') == $id ? 'selected' : '' }}>{{ $no }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fee Type</label>
                <select name="fee_type_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select</option>
                    @foreach($feeTypes as $id => $name)
                        <option value="{{ $id }}" {{ ($payment->fee_type_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                <input type="number" step="0.01" name="amount" value="{{ $payment->amount ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Date</label>
                <input type="date" name="payment_date" value="{{ $payment->payment_date ?? date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                <select name="payment_method" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Select</option>
                    <option value="cash" {{ ($payment->payment_method ?? '') === 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="bank" {{ ($payment->payment_method ?? '') === 'bank' ? 'selected' : '' }}>Bank</option>
                    <option value="online" {{ ($payment->payment_method ?? '') === 'online' ? 'selected' : '' }}>Online</option>
                    <option value="other" {{ ($payment->payment_method ?? '') === 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reference No</label>
                <input type="text" name="reference_no" value="{{ $payment->reference_no ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                <textarea name="remarks" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">{{ $payment->remarks ?? '' }}</textarea>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Save</button>
        </div>
    </form>
</div>
