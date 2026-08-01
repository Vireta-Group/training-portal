<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Report') }}
            @if($project ?? null)
                <span class="text-sm font-normal text-gray-400 ml-2">— {{ $project->name }}</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $batch->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $batch->course->name ?? '—' }} — Total Class Days: {{ $totalDays }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('attendance.batch', $batch) }}" class="btn btn-outline-indigo">Mark Attendance</a>
                            <a href="{{ route('attendance.index') }}" class="btn btn-outline-gray">Back</a>
                        </div>
                    </div>

                    @if($students->isEmpty())
                        <p class="text-gray-500 text-center py-8">No students in this batch.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b bg-gray-50">
                                        <th class="text-left p-3 font-medium">#</th>
                                        <th class="text-left p-3 font-medium">Student Name</th>
                                        <th class="text-center p-3 font-medium">Total Days</th>
                                        <th class="text-center p-3 font-medium">Present</th>
                                        <th class="text-center p-3 font-medium">Absent</th>
                                        <th class="text-center p-3 font-medium">Late</th>
                                        <th class="text-center p-3 font-medium">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        @php
                                            $studentAtt = $attendances->get($student->id, collect());
                                            $present = $studentAtt->where('status', 'present')->count();
                                            $absent = $studentAtt->where('status', 'absent')->count();
                                            $late = $studentAtt->where('status', 'late')->count();
                                            $totalAtt = $totalDays > 0 ? $totalDays : 1;
                                            $percentage = round((($present + $late) / $totalAtt) * 100, 1);
                                        @endphp
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="p-3 text-gray-400">{{ $loop->iteration }}</td>
                                            <td class="p-3">
                                                <div class="font-medium">{{ $student->name_en }}</div>
                                                @if($student->name_bn)
                                                    <div class="text-gray-500 text-xs">{{ $student->name_bn }}</div>
                                                @endif
                                            </td>
                                            <td class="p-3 text-center">{{ $totalDays }}</td>
                                            <td class="p-3 text-center">
                                                <span class="text-green-700 font-medium">{{ $present }}</span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="text-red-700 font-medium">{{ $absent }}</span>
                                            </td>
                                            <td class="p-3 text-center">
                                                <span class="text-yellow-700 font-medium">{{ $late }}</span>
                                            </td>
                                            <td class="p-3 text-center">
                                                @php
                                                    $pctColor = $percentage >= 75 ? 'text-green-700' : ($percentage >= 50 ? 'text-yellow-700' : 'text-red-700');
                                                @endphp
                                                <span class="font-semibold {{ $pctColor }}">{{ $percentage }}%</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
