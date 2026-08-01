<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Batch Attendance') }}
            @if($project ?? null)
                <span class="text-sm font-normal text-gray-400 ml-2">— {{ $project->name }}</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $batch->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $batch->course->name ?? '—' }}</p>
                        </div>
                        <a href="{{ route('attendance.report', $batch) }}" class="btn btn-outline-indigo">View Report</a>
                    </div>

                    <div class="mb-6">
                        <form method="GET" action="{{ route('attendance.batch', $batch) }}" class="flex items-end gap-4">
                            <div>
                                <x-input-label for="date" value="Select Date" />
                                <x-text-input id="date" class="block mt-1" type="date" name="date" value="{{ request('date', date('Y-m-d')) }}" />
                            </div>
                            <button type="submit" class="btn btn-solid-indigo">Load</button>
                        </form>
                    </div>

                    @if($dates->isNotEmpty())
                        <div class="mb-4 flex flex-wrap gap-2">
                            @foreach($dates as $attDate)
                                <a href="{{ request()->fullUrlWithQuery(['date' => $attDate->date]) }}"
                                   class="px-3 py-1 text-xs rounded border {{ request('date', date('Y-m-d')) === $attDate->date ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50' }}">
                                    {{ \Carbon\Carbon::parse($attDate->date)->format('d M') }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if($students->isEmpty())
                        <p class="text-gray-500 text-center py-8">No students assigned to this batch.</p>
                    @else
                        <form method="POST" action="{{ route('attendance.mark', $batch) }}">
                            @csrf
                            <input type="hidden" name="date" value="{{ request('date', date('Y-m-d')) }}">

                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b bg-gray-50">
                                            <th class="text-left p-3 font-medium">#</th>
                                            <th class="text-left p-3 font-medium">Student Name</th>
                                            <th class="text-left p-3 font-medium">Status *</th>
                                            <th class="text-left p-3 font-medium">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                            <tr class="border-b hover:bg-gray-50">
                                                <td class="p-3 text-gray-400">{{ $loop->iteration }}</td>
                                                <td class="p-3">
                                                    <div class="font-medium">{{ $student->name_en }}</div>
                                                    @if($student->name_bn)
                                                        <div class="text-gray-500 text-xs">{{ $student->name_bn }}</div>
                                                    @endif
                                                    <input type="hidden" name="students[{{ $loop->index }}][student_id]" value="{{ $student->id }}">
                                                </td>
                                                <td class="p-3">
                                                    <select name="students[{{ $loop->index }}][status]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm w-32" required>
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="late">Late</option>
                                                    </select>
                                                </td>
                                                <td class="p-3">
                                                    <input type="text" name="students[{{ $loop->index }}][remarks]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full" placeholder="Remarks">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex items-center justify-end mt-6 gap-3">
                                <a href="{{ route('attendance.index') }}" class="btn btn-outline-gray">Back</a>
                                <button type="submit" class="btn btn-solid-emerald">Save Attendance</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
