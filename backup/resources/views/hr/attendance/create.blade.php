<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mark Attendance') }}
            @if($project ?? null)
                <span class="text-sm font-normal text-gray-400 ml-2">— {{ $project->name }}</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('hr.attendance.store') }}">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="date" value="Date *" />
                            <x-text-input id="date" class="block mt-1 w-64" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        @if($employees->isEmpty())
                            <p class="text-gray-500 text-center py-8">No employees found. Add employees first.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b bg-gray-50">
                                            <th class="text-left p-3 font-medium">Employee</th>
                                            <th class="text-left p-3 font-medium">Status *</th>
                                            <th class="text-left p-3 font-medium">Check In</th>
                                            <th class="text-left p-3 font-medium">Check Out</th>
                                            <th class="text-left p-3 font-medium">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                            <tr class="border-b hover:bg-gray-50">
                                                <td class="p-3">
                                                    <div class="font-medium">{{ $employee->name }}</div>
                                                    <div class="text-gray-500 text-xs">{{ $employee->employee_id ?? $employee->designation?->name ?? '' }}</div>
                                                    <input type="hidden" name="employees[{{ $loop->index }}][employee_id]" value="{{ $employee->id }}">
                                                </td>
                                                <td class="p-3">
                                                    <select name="employees[{{ $loop->index }}][status]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm w-32" required>
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                        <option value="late">Late</option>
                                                        <option value="leave">Leave</option>
                                                    </select>
                                                </td>
                                                <td class="p-3">
                                                    <input type="time" name="employees[{{ $loop->index }}][check_in]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                                </td>
                                                <td class="p-3">
                                                    <input type="time" name="employees[{{ $loop->index }}][check_out]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                                </td>
                                                <td class="p-3">
                                                    <input type="text" name="employees[{{ $loop->index }}][remarks]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm w-36" placeholder="Remarks">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex items-center justify-end mt-6 gap-3">
                                <a href="{{ route('hr.attendance.index') }}" class="btn btn-outline-gray">Cancel</a>
                                <button type="submit" class="btn btn-solid-emerald">Save Attendance</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
