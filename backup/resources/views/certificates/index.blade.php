<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Certificates') }}
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
                        <h3 class="text-lg font-semibold">All Certificates</h3>
                        <a href="{{ route('certificates.create') }}" class="btn btn-solid-indigo">+ Issue Certificate</a>
                    </div>

                    @if($certificates->isEmpty())
                        <p class="text-gray-500 text-center py-8">No certificates yet. Issue your first certificate!</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b bg-gray-50">
                                        <th class="text-left p-3 font-medium">Certificate No</th>
                                        <th class="text-left p-3 font-medium">Student Name</th>
                                        <th class="text-left p-3 font-medium">Batch</th>
                                        <th class="text-left p-3 font-medium">Course</th>
                                        <th class="text-left p-3 font-medium">Issue Date</th>
                                        <th class="text-left p-3 font-medium">Status</th>
                                        <th class="text-left p-3 font-medium">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($certificates as $certificate)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="p-3 font-mono text-xs">{{ $certificate->certificate_no }}</td>
                                            <td class="p-3 font-medium">{{ $certificate->student?->name_en ?? '—' }}</td>
                                            <td class="p-3">{{ $certificate->batch?->name ?? '—' }}</td>
                                            <td class="p-3">{{ $certificate->course?->name ?? '—' }}</td>
                                            <td class="p-3">{{ $certificate->issue_date?->format('d M Y') ?? '—' }}</td>
                                            <td class="p-3">
                                                <span class="px-2 py-1 text-xs rounded
                                                    @if($certificate->status === 'issued') bg-green-100 text-green-700
                                                    @else bg-gray-100 text-gray-700 @endif">
                                                    {{ ucfirst($certificate->status) }}
                                                </span>
                                            </td>
                                            <td class="p-3 flex gap-2">
                                                <a href="{{ route('certificates.show', $certificate) }}" class="btn btn-outline-blue">View</a>
                                                <form action="{{ route('certificates.destroy', $certificate) }}" method="POST" class="inline" onsubmit="return confirm('Delete this certificate?')">
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
