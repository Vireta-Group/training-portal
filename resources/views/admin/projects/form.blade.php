<form id="crudForm" action="{{ $project ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST">
    @csrf
    @if($project) @method('PUT') @endif
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ $project->name ?? '' }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Name (Bangla)</label>
                <input type="text" name="name_bn" value="{{ $project->name_bn ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Code</label>
                <input type="text" name="code" value="{{ $project->code ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ ($project->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ ($project->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control">{{ $project->description ?? '' }}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
