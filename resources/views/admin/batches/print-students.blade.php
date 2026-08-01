@php $inst = auth()->user()->institute; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $batch->name }} - Student List</title>
    <style>
        @page { size: landscape; margin: 12mm; }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; }
        body { color: #333; }
        .no-print { text-align: center; margin-bottom: 15px; display: flex; gap: 10px; justify-content: center; }
        .no-print a, .no-print button { padding: 10px 20px; font-size: 14px; cursor: pointer; border: none; border-radius: 4px; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; }
        .no-print button { background: #0c4da2; color: #fff; }
        .no-print a { background: #6c757d; color: #fff; }
        .print-area { padding: 10px; }
        .header { text-align: center; margin-bottom: 18px; }
        .header h1 { font-size: 20px; color: #0c4da2; margin-bottom: 4px; }
        .header p { font-size: 13px; color: #555; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #333; padding: 5px 6px; text-align: left; }
        th { background: #0c4da2; color: #fff; font-weight: bold; }
        tr:nth-child(even) { background: #f9f9f9; }
        .text-center { text-align: center; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
            th { background: #0c4da2 !important; color: #fff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            tr:nth-child(even) { background: #f9f9f9 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <a href="{{ route('admin.batches.index') }}"><i class="fas fa-arrow-left"></i> Back to Batches</a>
        <button onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    </div>

    <div class="print-area">
        <div class="header">
            <h1>{{ $inst?->name ?? config('app.name') }}</h1>
            <p>
                @if($inst && $inst->mobile)<span><strong>Mobile:</strong> {{ $inst->mobile }}</span> &nbsp;|&nbsp; @endif
                @if($inst && $inst->email)<span><strong>Email:</strong> {{ $inst->email }}</span> &nbsp;|&nbsp; @endif
                @if($inst && $inst->address)<span><strong>Address:</strong> {{ $inst->address }}</span>@endif
            </p>
            <hr style="border:1px solid #0c4da2;margin:8px 0;">
            <h2 style="font-size:16px;color:#0c4da2;margin-bottom:4px;">{{ $batch->course?->project?->name ?? '' }} — {{ $batch->course?->name ?? '' }}</h2>
            <p><strong>Batch:</strong> {{ $batch->name }} @if($batch->shift)({{ $batch->shift }})@endif &nbsp;|&nbsp; <strong>Total Students:</strong> {{ $batch->students->count() }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="text-center" width="40">SL</th>
                    <th>Name (English)</th>
                    <th>Name (Bangla)</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Contact</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($batch->students as $index => $student)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $student->name_en }}</td>
                    <td>{{ $student->name_bn ?? '-' }}</td>
                    <td>{{ $student->father_name_en ?? '-' }}</td>
                    <td>{{ $student->mother_name_en ?? '-' }}</td>
                    <td>{{ $student->contact ?? '-' }}</td>
                    <td>{{ collect([$student->present_village, $student->present_road, $student->present_po, $student->present_upazila, $student->present_district])->filter()->implode(', ') ?: '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No students found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>