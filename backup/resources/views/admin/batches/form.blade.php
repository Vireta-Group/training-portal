<div class="p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $batch ? 'Edit Batch' : 'Add Batch' }}</h3>
    <form id="crudForm" action="{{ $batch ? route('admin.batches.update', $batch) : route('admin.batches.store') }}" method="POST">
        @csrf @if($batch) @method('PUT') @endif
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Project</label>
                <select name="project_id" id="project_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required onchange="loadCourses(this.value)">
                    <option value="">Select Project</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}" {{ ($batch->project_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                <select name="course_id" id="course_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Select Course</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ $batch->name ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name (Bangla)</label>
                <input type="text" name="name_bn" value="{{ $batch->name_bn ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Shift</label>
                <input type="text" name="shift" value="{{ $batch->shift ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Seat Capacity</label>
                <input type="number" name="seat_capacity" value="{{ $batch->seat_capacity ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <input type="date" name="start_date" value="{{ $batch->start_date ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input type="date" name="end_date" value="{{ $batch->end_date ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="active" {{ ($batch->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ ($batch->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Save</button>
        </div>
    </form>
</div>
<script>
function loadCourses(projectId) {
    if (!projectId) { $('#course_id').html('<option value="">Select Course</option>'); return; }
    $.getJSON('/admin/courses/by-project/' + projectId, function(data) {
        var opts = '<option value="">Select Course</option>';
        $.each(data, function(k, v) { opts += '<option value="' + k + '"' + ({{ ($batch->course_id ?? 'null') }} == k ? ' selected' : '') + '>' + v + '</option>'; });
        $('#course_id').html(opts);
    });
}
@if($batch) $(function() { loadCourses($('#project_id').val()); }); @endif
</script>
</div>
