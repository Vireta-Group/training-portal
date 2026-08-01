<form id="crudForm" action="{{ $batch ? route('admin.batches.update', $batch) : route('admin.batches.store') }}" method="POST">
    @csrf
    @if($batch) @method('PUT') @endif
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Project <span class="text-danger">*</span></label>
                <select name="project_id" id="project_id" class="form-select" required>
                    <option value="">Select Project</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}" {{ ($batch->project_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Course <span class="text-danger">*</span></label>
                <select name="course_id" id="course_id" class="form-select" required>
                    <option value="">Select Course</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ $batch->name ?? '' }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Name (Bangla)</label>
                <input type="text" name="name_bn" value="{{ $batch->name_bn ?? '' }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Shift</label>
                <input type="text" name="shift" value="{{ $batch->shift ?? '' }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Seat Capacity</label>
                <input type="number" name="seat_capacity" value="{{ $batch->seat_capacity ?? '' }}" class="form-control" min="0">
            </div>
            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ ($batch->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ ($batch->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Start Date</label>
                <input type="text" name="start_date" value="{{ $batch?->start_date?->format('d-m-Y') ?? '' }}" class="form-control datepicker" placeholder="dd-mm-yyyy">
            </div>
            <div class="col-md-6">
                <label class="form-label">End Date</label>
                <input type="text" name="end_date" value="{{ $batch?->end_date?->format('d-m-Y') ?? '' }}" class="form-control datepicker" placeholder="dd-mm-yyyy">
            </div>
            <div class="col-md-6">
                <label class="form-label">Start Time</label>
                <input type="time" name="start_time" value="{{ $batch->start_time ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">End Time</label>
                <input type="time" name="end_time" value="{{ $batch->end_time ?? '' }}" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
