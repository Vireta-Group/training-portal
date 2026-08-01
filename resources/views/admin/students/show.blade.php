@extends('admin.layouts.master')

@section('title', 'Student Profile - ' . config('app.name'))

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Back</a>
        <a href="{{ route('admin.students.print', $student) }}" class="btn btn-primary btn-sm no-print"><i class="fas fa-print me-1"></i> Print</a>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="text-center mb-4">
                <h3 class="mb-0">Admission Form</h3>
                <p class="text-muted">{{ config('app.name') }}</p>
            </div>

            <div class="row">
                <div class="col-md-3 text-center">
                    @if($student->photo_path)
                        <img src="{{ asset('storage/' . $student->photo_path) }}" class="img-thumbnail" style="max-width:180px;">
                    @else
                        <div class="border rounded p-5 text-muted">No Photo</div>
                    @endif
                </div>

                <div class="col-md-9">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width:200px">Name (English)</th>
                            <td>{{ $student->name_en }}</td>
                            <th style="width:200px">Reference No.</th>
                            <td>{{ $student->reference_no ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Name (Bangla)</th>
                            <td>{{ $student->name_bn ?? '-' }}</td>
                            <th>Contact</th>
                            <td>{{ $student->contact ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Project</th>
                            <td>{{ $student->project->name ?? '-' }}</td>
                            <th>Course</th>
                            <td>{{ $student->course->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Batch</th>
                            <td>{{ $student->batch->name ?? '-' }}</td>
                            <th>Status</th>
                            <td>{{ ucfirst($student->status ?? '-') }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ optional($student->dob)->format('d M Y') ?? '-' }}</td>
                            <th>Gender</th>
                            <td>{{ $student->gender ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nationality</th>
                            <td>{{ $student->nationality ?? '-' }}</td>
                            <th>Blood Group</th>
                            <td>{{ $student->blood_group ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Father's Name</th>
                            <td>{{ $student->father_name_en ?? '-' }}</td>
                            <th>Mother's Name</th>
                            <td>{{ $student->mother_name_en ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <h6>Addresses</h6>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Present Address</strong></p>
                    <p class="text-muted small">{{ $student->present_village ?? '' }} {{ $student->present_road ?? '' }} {{ $student->present_po ?? '' }} {{ $student->present_upazila ?? '' }} {{ $student->present_district ?? '' }} {{ $student->present_division ?? '' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Permanent Address</strong></p>
                    <p class="text-muted small">{{ $student->perm_village ?? '' }} {{ $student->perm_road ?? '' }} {{ $student->perm_po ?? '' }} {{ $student->perm_upazila ?? '' }} {{ $student->perm_district ?? '' }} {{ $student->perm_division ?? '' }}</p>
                </div>
            </div>

            <hr>

            <h6>Education</h6>
            <div class="row">
                <div class="col-md-4"><p class="mb-1"><strong>Degree:</strong> {{ $student->edu_degree ?? '-' }}</p></div>
                <div class="col-md-4"><p class="mb-1"><strong>Institute:</strong> {{ $student->edu_institute ?? '-' }}</p></div>
                <div class="col-md-2"><p class="mb-1"><strong>Year:</strong> {{ $student->edu_year ?? '-' }}</p></div>
                <div class="col-md-2"><p class="mb-1"><strong>CGPA:</strong> {{ $student->edu_cgpa ?? '-' }}</p></div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col-md-6 text-center">
                    <p class="mb-1">Date: {{ now()->format('d M Y') }}</p>
                </div>
                <div class="col-md-6 text-center">
                    @if($student->signature_path)
                        <img src="{{ asset('storage/' . $student->signature_path) }}" alt="signature" style="max-height:120px;">
                        <p class="mt-1 mb-0"><strong>{{ $student->name_en }}</strong></p>
                        <p class="small text-muted">Student's Signature</p>
                    @else
                        <div style="height:80px;border-bottom:1px solid #000; width:60%; margin:0 auto;"></div>
                        <p class="mt-1 mb-0"><strong>{{ $student->name_en }}</strong></p>
                        <p class="small text-muted">Student's Signature</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

