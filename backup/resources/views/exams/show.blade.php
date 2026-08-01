<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exam Details') }}
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
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $exam->name }}</h3>
                            @if($exam->name_bn)
                                <p class="text-gray-500 text-sm">{{ $exam->name_bn }}</p>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('exams.edit', $exam) }}" class="btn btn-outline-amber">Edit</a>
                            <a href="{{ route('exams.index') }}" class="btn btn-outline-gray">Back to List</a>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500 block">Batch</span>
                            <span class="font-medium">{{ $exam->batch?->name ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Course</span>
                            <span class="font-medium">{{ $exam->course?->name ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Type</span>
                            <span class="px-2 py-1 text-xs rounded inline-block mt-1
                                @switch($exam->type)
                                    @case('quiz') bg-blue-100 text-blue-700 @break
                                    @case('midterm') bg-purple-100 text-purple-700 @break
                                    @case('final') bg-red-100 text-red-700 @break
                                    @case('model_test') bg-orange-100 text-orange-700 @break
                                    @case('retake') bg-yellow-100 text-yellow-700 @break
                                    @default bg-gray-100 text-gray-700
                                @endswitch">
                                {{ ucfirst(str_replace('_', ' ', $exam->type)) }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Status</span>
                            <span class="px-2 py-1 text-xs rounded inline-block mt-1
                                @switch($exam->status)
                                    @case('pending') bg-yellow-100 text-yellow-700 @break
                                    @case('ongoing') bg-blue-100 text-blue-700 @break
                                    @case('completed') bg-green-100 text-green-700 @break
                                    @case('cancelled') bg-red-100 text-red-700 @break
                                    @default bg-gray-100 text-gray-700
                                @endswitch">
                                {{ ucfirst($exam->status ?? 'pending') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Exam Date</span>
                            <span class="font-medium">{{ $exam->exam_date?->format('d M Y') ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Total Marks</span>
                            <span class="font-medium">{{ $exam->total_marks }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Passing Marks</span>
                            <span class="font-medium">{{ $exam->passing_marks }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Results Entered</span>
                            <span class="font-medium">{{ $exam->results->count() }} student(s)</span>
                        </div>
                    </div>

                    @if($exam->description)
                        <div class="mt-4 p-3 bg-gray-50 rounded text-sm text-gray-600">
                            {{ $exam->description }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Results</h3>
                        @if($exam->status !== 'cancelled')
                            <a href="{{ route('exams.marks', $exam) }}" class="btn btn-solid-indigo">Enter Marks</a>
                        @endif
                    </div>

                    @if($exam->results->isEmpty())
                        <p class="text-gray-500 text-center py-8">No results entered yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b bg-gray-50">
                                        <th class="text-left p-3 font-medium">#</th>
                                        <th class="text-left p-3 font-medium">Student Name</th>
                                        <th class="text-left p-3 font-medium">Marks Obtained</th>
                                        <th class="text-left p-3 font-medium">Grade</th>
                                        <th class="text-left p-3 font-medium">GPA</th>
                                        <th class="text-left p-3 font-medium">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exam->results as $index => $result)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="p-3">{{ $index + 1 }}</td>
                                            <td class="p-3 font-medium">{{ $result->student?->name_en ?? '—' }}</td>
                                            <td class="p-3">{{ $result->marks_obtained }}</td>
                                            <td class="p-3">
                                                <span class="px-2 py-1 text-xs rounded
                                                    @if($result->grade === 'F') bg-red-100 text-red-700
                                                    @else bg-green-100 text-green-700 @endif">
                                                    {{ $result->grade }}
                                                </span>
                                            </td>
                                            <td class="p-3">{{ number_format($result->gpa, 2) }}</td>
                                            <td class="p-3 text-gray-500">{{ $result->remarks ?? '—' }}</td>
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
