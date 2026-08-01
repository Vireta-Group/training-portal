<x-filament-panels::page>
    <div class="space-y-6">
        {{ $this->form }}

        @if(count($students) > 0)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Students ({{ count($students) }})
                    </h3>
                    @php $dates = $this->getBatchesWithAttendance(); @endphp
                    @if(count($dates))
                        <div class="flex gap-1.5">
                            @foreach(array_slice($dates, 0, 7) as $attDate)
                                <button type="button" wire:click="$set('data.date', '{{ $attDate }}')"
                                    class="px-2.5 py-1 text-xs rounded-lg {{ ($data['date'] ?? '') === $attDate ? 'bg-indigo-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200' }}">
                                    {{ \Carbon\Carbon::parse($attDate)->format('d M') }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/30">
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">#</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Student</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Status</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($students as $index => $student)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/20 transition-colors">
                                    <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                        {{ $student['name'] }}
                                        <input type="hidden" wire:model="students.{{ $index }}.student_id" value="{{ $student['student_id'] }}" />
                                    </td>
                                    <td class="px-4 py-3">
                                        <select wire:model="students.{{ $index }}.status"
                                            class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="present">Present</option>
                                            <option value="absent">Absent</option>
                                            <option value="late">Late</option>
                                        </select>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="text" wire:model="students.{{ $index }}.remarks" placeholder="Remarks"
                                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end">
                {{ $this->saveAction }}
            </div>
        @elseif($selectedBatchId)
            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                No students found in this batch.
            </div>
        @endif
    </div>
</x-filament-panels::page>
