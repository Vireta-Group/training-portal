<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Attendance') }}
            @if($project ?? null)
                <span class="text-sm font-normal text-gray-400 ml-2">— {{ $project->name }}</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">All Attendance Records</h3>
                        <a href="{{ route('hr.attendance.create') }}" class="btn btn-solid-indigo">+ Mark Attendance</a>
                    </div>

                    @if($attendances->isEmpty())
                        <p class="text-gray-500 text-center py-8">No attendance records yet. Mark attendance for today!</p>
                    @else
                        @foreach($attendances as $date => $records)
                            <div class="mb-8">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="text-md font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}
                                    </h4>
                                    <a href="{{ route('hr.attendance.show', $date) }}" class="text-sm text-indigo-600 hover:text-indigo-800">View Details →</a>
                                </div>
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
                                            @foreach($records as $attendance)
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
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
