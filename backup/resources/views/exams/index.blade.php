<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exams') }}
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
                        <h3 class="text-lg font-semibold">All Exams</h3>
                        <a href="{{ route('exams.create') }}" class="btn btn-solid-indigo">+ Add Exam</a>
                    </div>

                    @if($exams->isEmpty())
                        <p class="text-gray-500 text-center py-8">No exams yet. Add your first exam!</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b bg-gray-50">
                                        <th class="text-left p-3 font-medium">Name</th>
                                        <th class="text-left p-3 font-medium">Batch</th>
                                        <th class="text-left p-3 font-medium">Course</th>
                                        <th class="text-left p-3 font-medium">Type</th>
                                        <th class="text-left p-3 font-medium">Date</th>
                                        <th class="text-left p-3 font-medium">Total Marks</th>
                                        <th class="text-left p-3 font-medium">Status</th>
                                        <th class="text-left p-3 font-medium">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exams as $exam)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="p-3">
                                                <div class="font-medium">{{ $exam->name }}</div>
                                                @if($exam->name_bn)
                                                    <div class="text-gray-500 text-xs">{{ $exam->name_bn }}</div>
                                                @endif
                                            </td>
                                            <td class="p-3">{{ $exam->batch?->name ?? '—' }}</td>
                                            <td class="p-3">{{ $exam->course?->name ?? '—' }}</td>
                                            <td class="p-3">
                                                <span class="px-2 py-1 text-xs rounded
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
                                            </td>
                                            <td class="p-3">{{ $exam->exam_date?->format('d M Y') ?? '—' }}</td>
                                            <td class="p-3">{{ $exam->total_marks }}</td>
                                            <td class="p-3">
                                                <span class="px-2 py-1 text-xs rounded
                                                    @switch($exam->status)
                                                        @case('pending') bg-yellow-100 text-yellow-700 @break
                                                        @case('ongoing') bg-blue-100 text-blue-700 @break
                                                        @case('completed') bg-green-100 text-green-700 @break
                                                        @case('cancelled') bg-red-100 text-red-700 @break
                                                        @default bg-gray-100 text-gray-700
                                                    @endswitch">
                                                    {{ ucfirst($exam->status ?? 'pending') }}
                                                </span>
                                            </td>
                                            <td class="p-3 flex gap-2">
                                                <a href="{{ route('exams.show', $exam) }}" class="btn btn-outline-blue">View</a>
                                                <a href="{{ route('exams.edit', $exam) }}" class="btn btn-outline-amber">Edit</a>
                                                <form action="{{ route('exams.destroy', $exam) }}" method="POST" class="inline" onsubmit="return confirm('Delete this exam?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-red">Delete</button>
                                                </form>
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
