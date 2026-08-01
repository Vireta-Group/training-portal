<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enter Marks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500 block">Exam</span>
                            <span class="font-medium">{{ $exam->name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Batch</span>
                            <span class="font-medium">{{ $exam->batch?->name ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Course</span>
                            <span class="font-medium">{{ $exam->course?->name ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Total Marks</span>
                            <span class="font-medium">{{ $exam->total_marks }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('exams.marks.store', $exam) }}">
                        @csrf

                        @if($students->isEmpty())
                            <p class="text-gray-500 text-center py-8">No students found in this batch.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b bg-gray-50">
                                            <th class="text-left p-3 font-medium">#</th>
                                            <th class="text-left p-3 font-medium">Student Name</th>
                                            <th class="text-left p-3 font-medium">Marks Obtained (Max: {{ $exam->total_marks }}) *</th>
                                            <th class="text-left p-3 font-medium">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $index => $student)
                                            @php
                                                $existing = $results->get($student->id);
                                            @endphp
                                            <tr class="border-b hover:bg-gray-50">
                                                <td class="p-3">{{ $index + 1 }}</td>
                                                <td class="p-3 font-medium">{{ $student->name_en }}</td>
                                                <td class="p-3">
                                                    <input type="hidden" name="marks[{{ $index }}][student_id]" value="{{ $student->id }}">
                                                    <x-text-input class="block w-32" type="number" name="marks[{{ $index }}][marks_obtained]"
                                                        value="{{ old('marks.' . $index . '.marks_obtained', $existing?->marks_obtained) }}"
                                                        min="0" max="{{ $exam->total_marks }}" step="any" required />
                                                    <x-input-error :messages="$errors->get('marks.' . $index . '.marks_obtained')" class="mt-1" />
                                                </td>
                                                <td class="p-3">
                                                    <x-text-input class="block w-full" type="text" name="marks[{{ $index }}][remarks]"
                                                        value="{{ old('marks.' . $index . '.remarks', $existing?->remarks) }}" />
                                                    <x-input-error :messages="$errors->get('marks.' . $index . '.remarks')" class="mt-1" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex items-center justify-end mt-6 gap-3">
                                <a href="{{ route('exams.show', $exam) }}" class="btn btn-outline-gray">Cancel</a>
                                <button type="submit" class="btn btn-solid-emerald">Save All Marks</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
