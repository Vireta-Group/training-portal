<x-filament-panels::page>
    <div class="space-y-6">
        {{ $this->form }}

        @if(count($employees) > 0)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Employees ({{ count($employees) }})
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/30">
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">#</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Employee</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Status</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Check In</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Check Out</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($employees as $index => $emp)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/20 transition-colors">
                                    <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                        {{ $emp['name'] }}
                                        <input type="hidden" wire:model="employees.{{ $index }}.employee_id" />
                                    </td>
                                    <td class="px-4 py-3">
                                        <select wire:model="employees.{{ $index }}.status"
                                            class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="present">Present</option>
                                            <option value="absent">Absent</option>
                                            <option value="late">Late</option>
                                            <option value="leave">Leave</option>
                                        </select>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="time" wire:model="employees.{{ $index }}.check_in"
                                            class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="time" wire:model="employees.{{ $index }}.check_out"
                                            class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="text" wire:model="employees.{{ $index }}.remarks" placeholder="Remarks"
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
        @endif
    </div>
</x-filament-panels::page>
