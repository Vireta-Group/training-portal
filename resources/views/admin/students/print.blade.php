<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->name_en }} - Application Form</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; }
        body { background-color: #f5f5f5; padding: 20px; color: #333; }
        .form-container { max-width: 900px; margin: 0 auto; background-color: #fff; padding: 30px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0,0,0,0.05); position: relative; }
        .form-header { display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 3px solid #0c4da2; padding-bottom: 12px; margin-bottom: 20px; }
        .logo-area { display: flex; align-items: center; gap: 15px; }
        .logo-placeholder { width: 65px; height: 45px; background-color: #0c4da2; display: flex; align-items: center; justify-content: center; border-radius: 4px; }
        .logo-placeholder span { font-size: 10px; color: #fff; }
        .company-details h1 { color: #0c4da2; font-size: 24px; font-weight: bold; }
        .company-details p { font-size: 12px; color: #555; margin-top: 4px; }
        .form-id-date { text-align: right; }
        .form-id-date h2 { color: #0c4da2; font-size: 18px; font-weight: bold; word-break: break-all; }
        .form-id-date p { font-size: 12px; color: #777; margin-top: 4px; }

        .main-title { text-align: center; color: #0c4da2; font-size: 16px; font-weight: bold; letter-spacing: 0.5px; margin: 2px 0 2px 0; }
        .form-section { margin-bottom: 22px; }
        .section-title { color: #0c4da2; font-size: 13px; font-weight: bold; border-bottom: 2px solid #0c4da2; padding-bottom: 4px; margin-bottom: 8px; }
        .personal-grid { display: flex; border: 1px solid #ccc; border-bottom: none; }
        .photo-box { width: 135px; min-height: 150px; border-right: 1px solid #ccc; background-color: #fafafa; display: flex; align-items: center; justify-content: center; padding: 10px; }
        .photo-box img { max-width: 115px; max-height: 140px; }
        .photo-box span { border: 1.5px dashed #bbb; padding: 35px 15px; color: #999; font-size: 12px; }
        .info-fields { flex-grow: 1; display: flex; flex-direction: column; }
        .row { display: flex; width: 100%; border-bottom: 1px solid #ccc; background-color: #fff; }
        .info-fields .row:nth-child(even) { background-color: #fafafa; }
        .label, .val { padding: 8px 10px; font-size: 12px; display: flex; align-items: center; }
        .label { background-color: #f7f7f7; font-weight: bold; color: #444; border-right: 1px solid #ccc; width: 18%; }
        .val { color: #222; border-right: 1px solid #ccc; width: 32%; }
        .val:last-child { border-right: none; }
        .bottom-personal { border: 1px solid #ccc; border-top: none; }
        .cell-sm { width: 14.7%; }
        .cell-md { width: 28.5%; }
        .cell-lg { width: 38.4%; }
        .cell-xl { width: 85.3%; border-right: none; }
        .form-footer { display: flex; justify-content: space-between; margin-top: 40px; padding: 0 10px; border-top: 1px solid #ccc; padding-top: 15px; }
        .signature-line { width: 25%; text-align: center; }
        .signature-line .line { border-top: 2px solid #333; margin-bottom: 6px; }
        .signature-line p { font-size: 12px; font-weight: bold; color: #333; }
        .no-print { text-align: center; margin-bottom: 15px; display: flex; gap: 10px; justify-content: center; }
        .no-print a, .no-print button { padding: 10px 20px; font-size: 14px; cursor: pointer; border: none; border-radius: 4px; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; }
        .no-print button { background: #0c4da2; color: #fff; }
        .no-print a { background: #6c757d; color: #fff; }
        @media print {
            body { background: #fff; padding: 0; }
            .form-container { box-shadow: none; border: none; padding: 15px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <a href="{{ route('admin.students.show', $student) }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back to Profile</a>
        <button onclick="window.print()" class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</button>
    </div>

    <div class="form-container">

        <header class="form-header">
            <div class="logo-area">
                <div class="logo-placeholder">
                    @php $instLogo = auth()->user()->institute->logo; @endphp
                    @if($instLogo)
                        <img src="{{ asset('storage/' . $instLogo) }}" alt="Logo" style="max-width:65px; max-height:45px;">
                    @else
                        <span>{{ config('app.name') }}</span>
                    @endif
                </div>
                <div class="company-details">
                    <h1>{{ auth()->user()->institute->name ?? config('app.name') }}</h1>
                    <p>Mobile: {{ auth()->user()->institute->mobile ?? 'N/A' }} | Email: {{ auth()->user()->institute->email ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="form-id-date">
                <h2>{{ auth()->user()->institute->code ?? 'N/A' }}</h2>
                <p>{{ auth()->user()->institute->address ?? 'N/A' }}</p>
            </div>
        </header>

        <div class="main-title">STUDENT APPLICATION FORM</div>

        <section class="form-section">
            <h3 class="section-title">Personal Information</h3>
            <div class="grid-container personal-grid">
                <div class="photo-box">
                    @if($student->photo_path)
                        <img src="{{ asset('storage/' . $student->photo_path) }}" alt="Photo">
                    @else
                        <span>No Photo</span>
                    @endif
                </div>
                <div class="info-fields">
                    <div class="row">
                        <div class="label">Name (English)</div>
                        <div class="val">{{ $student->name_en ?? '-' }}</div>
                        <div class="label">Name (Bangla)</div>
                        <div class="val">{{ $student->name_bn ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Father's Name</div>
                        <div class="val">{{ $student->father_name_en ?? $student->father_name_bn ?? '-' }}</div>
                        <div class="label">Mother's Name</div>
                        <div class="val">{{ $student->mother_name_en ?? $student->mother_name_bn ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Date of Birth</div>
                        <div class="val">{{ optional($student->dob)->format('d/m/Y') ?? '-' }}</div>
                        <div class="label">Gender</div>
                        <div class="val">{{ $student->gender ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Mobile</div>
                        <div class="val">{{ $student->contact ?? '-' }}</div>
                        <div class="label">Email</div>
                        <div class="val">{{ $student->email ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Nationality</div>
                        <div class="val">{{ $student->nationality ?? 'Bangladeshi' }}</div>
                        <div class="label">Religion</div>
                        <div class="val">{{ $student->religion ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="label">Blood Group</div>
                        <div class="val">{{ $student->blood_group ?? '-' }}</div>
                        <div class="label">Occupation</div>
                        <div class="val">{{ $student->occupation ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="info-fields bottom-personal">
                <div class="row">
                    <div class="label cell-sm">ID Type</div>
                    <div class="val cell-md">{{ $student->id_type ?? '-' }}</div>
                    <div class="label cell-sm">ID Number</div>
                    <div class="val cell-lg">{{ $student->id_no ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label cell-sm">Guardian</div>
                    <div class="val cell-xl">{{ $student->guardian_relation ?? 'Guardian' }}: {{ $student->guardian_contact ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label cell-sm">Course</div>
                    <div class="val cell-md">{{ optional($student->course)->name ?? '-' }}</div>
                    <div class="label cell-sm">Batch</div>
                    <div class="val cell-lg">{{ optional($student->batch)->name ?? '-' }}</div>
                </div>
            </div>
        </section>

        <section class="form-section">
            <h3 class="section-title">Present Address</h3>
            <div class="info-fields">
                <div class="row">
                    <div class="label cell-sm">Village / Road</div>
                    <div class="val cell-xl">{{ $student->present_village ?? '' }} {{ $student->present_road ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="label cell-sm">Post Office</div>
                    <div class="val cell-md">{{ $student->present_po ?? '-' }}</div>
                    <div class="label cell-sm">Upazila</div>
                    <div class="val cell-lg">{{ $student->present_upazila ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label cell-sm">District</div>
                    <div class="val cell-md">{{ $student->present_district ?? '-' }}</div>
                    <div class="label cell-sm">Division</div>
                    <div class="val cell-lg">{{ $student->present_division ?? '-' }}</div>
                </div>
            </div>
        </section>

        <section class="form-section">
            <h3 class="section-title">Permanent Address</h3>
            <div class="info-fields">
                <div class="row">
                    <div class="label cell-sm">Village / Road</div>
                    <div class="val cell-xl">{{ $student->perm_village ?? '' }} {{ $student->perm_road ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="label cell-sm">Post Office</div>
                    <div class="val cell-md">{{ $student->perm_po ?? '-' }}</div>
                    <div class="label cell-sm">Upazila</div>
                    <div class="val cell-lg">{{ $student->perm_upazila ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label cell-sm">District</div>
                    <div class="val cell-md">{{ $student->perm_district ?? '-' }}</div>
                    <div class="label cell-sm">Division</div>
                    <div class="val cell-lg">{{ $student->perm_division ?? '-' }}</div>
                </div>
            </div>
        </section>

        <section class="form-section">
            <h3 class="section-title">Educational Qualification</h3>
            <div class="info-fields">
                <div class="row">
                    <div class="label cell-sm">Degree</div>
                    <div class="val cell-md">{{ $student->edu_degree ?? '-' }}</div>
                    <div class="label cell-sm">Institute</div>
                    <div class="val cell-lg">{{ $student->edu_institute ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label cell-sm">Passing Year</div>
                    <div class="val cell-md">{{ $student->edu_year ?? '-' }}</div>
                    <div class="label cell-sm">CGPA / GPA</div>
                    <div class="val cell-lg">{{ $student->edu_cgpa ?? '-' }}</div>
                </div>
                <div class="row">
                    <div class="label cell-sm">Address</div>
                    <div class="val cell-xl">{{ $student->edu_address ?? '-' }}</div>
                </div>
            </div>
        </section>

        <footer class="form-footer">
            <div class="signature-line">
                <div class="line"></div>
                <p>Student's Signature</p>
            </div>
            <div class="signature-line">
                <div class="line"></div>
                <p>Guardian's Signature</p>
            </div>
            <div class="signature-line">
                <div class="line"></div>
                <p>Authorized Signature</p>
            </div>
        </footer>
    </div>
</body>
</html>
