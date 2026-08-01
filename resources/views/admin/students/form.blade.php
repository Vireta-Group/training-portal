<form id="crudForm" action="{{ $student ? route('admin.students.update', $student) : route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($student) @method('PUT') @endif
    <div class="modal-body">
        <!-- Step 1: Selectors -->
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label">Project <span class="text-danger">*</span></label>
                <select name="project_id" id="s_project_id" class="form-select" required>
                    <option value="">Select Project</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}" {{ ($student->project_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4" id="courseWrapper" style="{{ $student ? '' : 'display:none' }}">
                <label class="form-label">Course <span class="text-danger">*</span></label>
                <select name="course_id" id="s_course_id" class="form-select" required>
                    <option value="">Select Course</option>
                </select>
            </div>
            <div class="col-md-4" id="batchWrapper" style="{{ $student ? '' : 'display:none' }}">
                <label class="form-label">Batch</label>
                <select name="batch_id" id="s_batch_id" class="form-select">
                    <option value="">Select Batch</option>
                </select>
            </div>
        </div>

        <!-- Step 2: Full form (visible after batch selected) -->
        <div id="fullFormFields" style="{{ $student ? '' : 'display:none' }}">
            <div class="row g-3">
                <div class="col-12"><hr class="my-1"></div>
                <div class="col-md-6">
                    <label class="form-label">Name (English) <span class="text-danger">*</span></label>
                    <input type="text" name="name_en" value="{{ $student->name_en ?? '' }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Name (Bangla)</label>
                    <input type="text" name="name_bn" value="{{ $student->name_bn ?? '' }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Father's Name</label>
                    <input type="text" name="father_name_en" value="{{ $student->father_name_en ?? '' }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mother's Name</label>
                    <input type="text" name="mother_name_en" value="{{ $student->mother_name_en ?? '' }}" class="form-control">
                </div>
                <div class="col-12"><hr class="my-1"></div>

                <div class="col-md-4">
                    <label class="form-label">Mobile <span class="text-danger">*</span></label>
                    <input type="text" name="contact" value="{{ $student->contact ?? '' }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $student->email ?? '' }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date of Birth</label>
                    @php
                        $dobVal = '';
                        if (!empty($student?->dob)) {
                            $dobVal = \Illuminate\Support\Carbon::parse($student->dob)->format('d-m-Y');
                        }
                    @endphp
                    <input type="text" name="dob" value="{{ $dobVal }}" class="form-control datepicker" placeholder="dd-mm-yyyy">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select</option>
                        <option value="Male" {{ ($student->gender ?? '') === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ ($student->gender ?? '') === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Religion</label>
                    <select name="religion" class="form-select">
                        <option value="">Select</option>
                        <option value="Islam" {{ ($student->religion ?? '') === 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Hinduism" {{ ($student->religion ?? '') === 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                        <option value="Buddhism" {{ ($student->religion ?? '') === 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
                        <option value="Christianity" {{ ($student->religion ?? '') === 'Christianity' ? 'selected' : '' }}>Christianity</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Blood Group</label>
                    <select name="blood_group" class="form-select">
                        <option value="">Select</option>
                        @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                            <option value="{{ $bg }}" {{ ($student->blood_group ?? '') === $bg ? 'selected' : '' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nationality</label>
                    <input type="text" name="nationality" value="{{ $student->nationality ?? 'Bangladeshi' }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Occupation</label>
                    <input type="text" name="occupation" value="{{ $student->occupation ?? '' }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="applied" {{ ($student->status ?? '') === 'applied' ? 'selected' : '' }}>Applied</option>
                        <option value="admitted" {{ ($student->status ?? '') === 'admitted' ? 'selected' : '' }}>Admitted</option>
                        <option value="active" {{ ($student->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ ($student->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="graduated" {{ ($student->status ?? '') === 'graduated' ? 'selected' : '' }}>Graduated</option>
                    </select>
                </div>

                <div class="col-12"><hr class="my-1"></div>

                <!-- Additional fields: local names, id and guardian -->
                <div class="col-md-6">
                    <label class="form-label">Father's Name (Bangla)</label>
                    <input type="text" name="father_name_bn" value="{{ $student->father_name_bn ?? '' }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mother's Name (Bangla)</label>
                    <input type="text" name="mother_name_bn" value="{{ $student->mother_name_bn ?? '' }}" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">ID Type</label>
                    <input type="text" name="id_type" value="{{ $student->id_type ?? '' }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">ID No.</label>
                    <input type="text" name="id_no" value="{{ $student->id_no ?? '' }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Guardian Contact</label>
                    <input type="text" name="guardian_contact" value="{{ $student->guardian_contact ?? '' }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Guardian Relation</label>
                    <input type="text" name="guardian_relation" value="{{ $student->guardian_relation ?? '' }}" class="form-control">
                </div>

                <div class="col-12"><hr class="my-1"></div>

                <!-- Addresses: present -->
                <div class="col-md-6">
                    <h6>Present Address</h6>
                    <label class="form-label">Village</label>
                    <input type="text" name="present_village" value="{{ $student->present_village ?? '' }}" class="form-control mb-2">
                    <label class="form-label">Road</label>
                    <input type="text" name="present_road" value="{{ $student->present_road ?? '' }}" class="form-control mb-2">
                    <label class="form-label">PO</label>
                    <input type="text" name="present_po" value="{{ $student->present_po ?? '' }}" class="form-control mb-2">
                </div>

                <div class="col-md-6">
                    <h6>Permanent Address</h6>
                    <label class="form-label">Village</label>
                    <input type="text" name="perm_village" value="{{ $student->perm_village ?? '' }}" class="form-control mb-2">
                    <label class="form-label">Road</label>
                    <input type="text" name="perm_road" value="{{ $student->perm_road ?? '' }}" class="form-control mb-2">
                    <label class="form-label">PO</label>
                    <input type="text" name="perm_po" value="{{ $student->perm_po ?? '' }}" class="form-control mb-2">
                </div>

                <div class="col-12"><hr class="my-1"></div>

                <!-- Education -->
                <div class="col-md-4">
                    <label class="form-label">Degree</label>
                    <input type="text" name="edu_degree" value="{{ $student->edu_degree ?? '' }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Institute</label>
                    <input type="text" name="edu_institute" value="{{ $student->edu_institute ?? '' }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Year</label>
                    <input type="text" name="edu_year" value="{{ $student->edu_year ?? '' }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">CGPA</label>
                    <input type="text" name="edu_cgpa" value="{{ $student->edu_cgpa ?? '' }}" class="form-control">
                </div>
                <div class="col-12 mt-2">
                    <label class="form-label">Education Address / Details</label>
                    <textarea name="edu_address" class="form-control" rows="2">{{ $student->edu_address ?? '' }}</textarea>
                </div>

                <div class="col-12"><hr class="my-1"></div>

                <!-- Uploads -->
                <div class="col-md-4">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    @if($student && $student->photo_path)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $student->photo_path) }}" class="img-thumbnail" style="max-height:80px">
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label class="form-label">NID / Birth Certificate</label>
                    <input type="file" name="nid" class="form-control" accept="image/*,.pdf">
                    @if($student && $student->nid_path)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $student->nid_path) }}" target="_blank" class="btn btn-sm btn-outline-info">View File</a>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label class="form-label">Signature</label>
                    <input type="file" name="signature" class="form-control" accept="image/*">
                    @if($student && $student->signature_path)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $student->signature_path) }}" class="img-thumbnail" style="max-height:60px">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" id="formFooter" style="{{ $student ? '' : 'display:none' }}">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
