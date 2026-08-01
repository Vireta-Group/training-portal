<form id="crudForm" action="{{ $course ? route('admin.courses.update', $course) : route('admin.courses.store') }}" method="POST">
    @csrf
    @if($course) @method('PUT') @endif
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Project <span class="text-danger">*</span></label>
                <select name="project_id" class="form-select" required>
                    <option value="">Select Project</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}" {{ ($course->project_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ $course->name ?? '' }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Name (Bangla)</label>
                <input type="text" name="name_bn" value="{{ $course->name_bn ?? '' }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Duration (months) <span class="text-danger">*</span></label>
                <input type="number" name="duration" value="{{ $course->duration ?? '' }}" class="form-control" required min="1">
            </div>
            <div class="col-md-4">
                <label class="form-label">Fee <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="fee" value="{{ $course->fee ?? '' }}" class="form-control" required min="0">
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control">{{ $course->description ?? '' }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ ($course->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ ($course->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
