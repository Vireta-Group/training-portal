<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance for') }} {{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}
            @if($project ?? null)
                <span class="text-sm font-normal text-gray-400 ml-2">— {{ $project->name }}</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">
                            {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                            <span class="text-sm font-normal text-gray-400 ml-2">({{ $attendances->count() }} records)</span>
                        </h3>
                        <div class="flex gap-2">
                            <a href="{{ route('hr.attendance.create') }}" class="btn btn-outline-indigo">Edit</a>
                            <a href="{{ route('hr.attendance.index') }}" class="btn btn-outline-gray">Back to All</a>
                        </div>
                    </div>

                    @if($attendances->isEmpty())
                        <p class="text-gray-500 text-center py-8">No attendance records for this date.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b bg-gray-50">
                                        <th class="text-left p-3 font-medium">Employee</th>
                                        <th class="text-left p-3 font-medium">Status</th>
                                        <th class="text-left p-3 font-medium">Check In</th>
                                        <th class="text-left p-3 font-medium">Check Out</th>
                                        <th class="text-left p-3 font-medium">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendances as $attendance)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="p-3">
                                                <div class="font-medium">{{ $attendance->employee->name ?? '—' }}</div>
                                                <div class="text-gray-500 text-xs">{{ $attendance->employee->employee_id ?? '' }}</div>
                                            </td>
                                            <td class="p-3">
                                                @php
                                                    $statusColors = [
                                                        'present' => 'bg-green-100 text-green-700',
                                                        'absent' => 'bg-red-100 text-red-700',
                                                        'late' => 'bg-yellow-100 text-yellow-700',
                                                        'leave' => 'bg-blue-100 text-blue-700',
                                                    ];
                                                    $color = $statusColors[$attendance->status] ?? 'bg-gray-100 text-gray-700';
                                                @endphp
                                                <span class="px-2 py-1 text-xs rounded {{ $color }}">
                                                    {{ ucfirst($attendance->status) }}
                                                </span>
                                            </td>
                                            <td class="p-3">{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') : '—' }}</td>
                                            <td class="p-3">{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') : '—' }}</td>
                                            <td class="p-3 text-gray-500">{{ $attendance->remarks ?? '—' }}</td>
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
