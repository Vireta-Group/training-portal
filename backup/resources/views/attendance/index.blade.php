<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Attendance') }}
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
                        <h3 class="text-lg font-semibold">Active Batches</h3>
                    </div>

                    @if($batches->isEmpty())
                        <p class="text-gray-500 text-center py-8">No active batches found.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($batches as $batch)
                                <a href="{{ route('attendance.batch', $batch) }}" class="block border rounded-lg hover:shadow-md transition bg-white">
                                    <div class="p-5">
                                        <h4 class="font-semibold text-lg text-gray-800">{{ $batch->name }}</h4>
                                        @if($batch->name_bn)
                                            <p class="text-gray-500 text-sm">{{ $batch->name_bn }}</p>
                                        @endif
                                        <div class="mt-3 flex items-center gap-2">
                                            <span class="px-2 py-0.5 text-xs rounded bg-indigo-100 text-indigo-700">
                                                {{ $batch->course->name ?? '—' }}
                                            </span>
                                            @if($batch->shift)
                                                <span class="text-xs text-gray-400">{{ $batch->shift }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-2 text-xs text-gray-400">
                                            @if($batch->start_date)
                                                {{ \Carbon\Carbon::parse($batch->start_date)->format('d M Y') }}
                                                @if($batch->end_date) — {{ \Carbon\Carbon::parse($batch->end_date)->format('d M Y') }} @endif
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
