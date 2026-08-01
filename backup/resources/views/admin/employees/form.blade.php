<div class="p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $employee ? 'Edit Employee' : 'Add Employee' }}</h3>
    <form id="crudForm" action="{{ $employee ? route('admin.employees.update', $employee) : route('admin.employees.store') }}" method="POST">
        @csrf @if($employee) @method('PUT') @endif
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                <select name="department_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Select</option>
                    @foreach($departments as $id => $name)
                        <option value="{{ $id }}" {{ ($employee->department_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                <select name="designation_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Select</option>
                    @foreach($designations as $id => $name)
                        <option value="{{ $id }}" {{ ($employee->designation_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Employee ID</label>
                <input type="text" name="employee_id" value="{{ $employee->employee_id ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ $employee->name ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name (Bangla)</label>
                <input type="text" name="name_bn" value="{{ $employee->name_bn ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name</label>
                <input type="text" name="father_name" value="{{ $employee->father_name ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Name</label>
                <input type="text" name="mother_name" value="{{ $employee->mother_name ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
                <input type="text" name="contact" value="{{ $employee->contact ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ $employee->email ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ $employee->dob ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select</option>
                    <option value="Male" {{ ($employee->gender ?? '') === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ ($employee->gender ?? '') === 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Joining Date</label>
                <input type="date" name="joining_date" value="{{ $employee->joining_date ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                <input type="number" step="0.01" name="salary" value="{{ $employee->salary ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
                <select name="religion" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select</option>
                    <option value="Islam" {{ ($employee->religion ?? '') === 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Hinduism" {{ ($employee->religion ?? '') === 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                    <option value="Buddhism" {{ ($employee->religion ?? '') === 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
                    <option value="Christianity" {{ ($employee->religion ?? '') === 'Christianity' ? 'selected' : '' }}>Christianity</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
                <select name="blood_group" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select</option>
                    @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                        <option value="{{ $bg }}" {{ ($employee->blood_group ?? '') === $bg ? 'selected' : '' }}>{{ $bg }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="active" {{ ($employee->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ ($employee->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Present Address</label>
                <textarea name="present_address" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">{{ $employee->present_address ?? '' }}</textarea>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Save</button>
        </div>
    </form>
</div>
