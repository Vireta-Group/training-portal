<div class="p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $student ? 'Edit Student' : 'Add Student' }}</h3>
    <form id="crudForm" action="{{ $student ? route('admin.students.update', $student) : route('admin.students.store') }}" method="POST">
        @csrf @if($student) @method('PUT') @endif
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Project</label>
                <select name="project_id" id="s_project_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required onchange="loadSCourses()">
                    <option value="">Select Project</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}" {{ ($student->project_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                <select name="course_id" id="s_course_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required onchange="loadSBatches()">
                    <option value="">Select Course</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                <select name="batch_id" id="s_batch_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select Batch</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="applied" {{ ($student->status ?? '') === 'applied' ? 'selected' : '' }}>Applied</option>
                    <option value="admitted" {{ ($student->status ?? '') === 'admitted' ? 'selected' : '' }}>Admitted</option>
                    <option value="active" {{ ($student->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ ($student->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="graduated" {{ ($student->status ?? '') === 'graduated' ? 'selected' : '' }}>Graduated</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name (English)</label>
                <input type="text" name="name_en" value="{{ $student->name_en ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name (Bangla)</label>
                <input type="text" name="name_bn" value="{{ $student->name_bn ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name</label>
                <input type="text" name="father_name_en" value="{{ $student->father_name_en ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Name</label>
                <input type="text" name="mother_name_en" value="{{ $student->mother_name_en ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mobile</label>
                <input type="text" name="contact" value="{{ $student->contact ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ $student->email ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ $student->dob ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select</option>
                    <option value="Male" {{ ($student->gender ?? '') === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ ($student->gender ?? '') === 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
                <select name="religion" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select</option>
                    <option value="Islam" {{ ($student->religion ?? '') === 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Hinduism" {{ ($student->religion ?? '') === 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                    <option value="Buddhism" {{ ($student->religion ?? '') === 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
                    <option value="Christianity" {{ ($student->religion ?? '') === 'Christianity' ? 'selected' : '' }}>Christianity</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
                <select name="blood_group" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Select</option>
                    @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                        <option value="{{ $bg }}" {{ ($student->blood_group ?? '') === $bg ? 'selected' : '' }}>{{ $bg }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
                <input type="text" name="nationality" value="{{ $student->nationality ?? 'Bangladeshi' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                <input type="text" name="occupation" value="{{ $student->occupation ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Save</button>
        </div>
    </form>
</div>
<script>
function loadSCourses() {
    var pid = $('#s_project_id').val();
    if (!pid) { $('#s_course_id, #s_batch_id').html('<option value="">Select...</option>'); return; }
    $.getJSON('/admin/courses/by-project/' + pid, function(data) {
        var opts = '<option value="">Select Course</option>';
        $.each(data, function(k, v) { opts += '<option value="' + k + '">' + v + '</option>'; });
        $('#s_course_id').html(opts);
    });
}
function loadSBatches() {
    var cid = $('#s_course_id').val();
    if (!cid) { $('#s_batch_id').html('<option value="">Select Batch</option>'); return; }
    $.getJSON('/admin/batches/by-course/' + cid, function(data) {
        var opts = '<option value="">Select Batch</option>';
        $.each(data, function(k, v) { opts += '<option value="' + k + '">' + v + '</option>'; });
        $('#s_batch_id').html(opts);
    });
}
@if($student)
$(function() {
    loadSCourses();
    setTimeout(function() { $('#s_course_id').val({{ $student->course_id ?? 'null' }}); loadSBatches(); }, 300);
});
@endif
</script>
</div>
