<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Certificate Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Certificate of Completion</h3>
                        <div class="flex gap-2">
                            <a href="{{ route('certificates.index') }}" class="btn btn-outline-gray">Back to List</a>
                            <button onclick="window.print()" class="btn btn-solid-indigo">Print</button>
                        </div>
                    </div>

                    <div class="border-2 border-gray-300 rounded-lg p-8 print:border-0">
                        <div class="text-center mb-8">
                            <h1 class="text-2xl font-bold text-gray-800">{{ $certificate->institute?->name ?? 'Training Institute' }}</h1>
                            <p class="text-sm text-gray-500 mt-1">Certificate No: {{ $certificate->certificate_no }}</p>
                        </div>

                        <div class="text-center mb-8">
                            <p class="text-lg text-gray-600">This is to certify that</p>
                            <h2 class="text-3xl font-bold text-gray-800 my-4">{{ $certificate->student?->name_en ?? '—' }}</h2>
                            <p class="text-lg text-gray-600">has successfully completed the course</p>
                            <h3 class="text-2xl font-semibold text-gray-800 my-4">{{ $certificate->course?->name ?? '—' }}</h3>
                            <p class="text-gray-600">Batch: {{ $certificate->batch?->name ?? '—' }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-8 mt-8 text-sm">
                            <div>
                                <span class="text-gray-500 block">Issue Date</span>
                                <span class="font-medium">{{ $certificate->issue_date?->format('d M Y') ?? '—' }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-gray-500 block">Status</span>
                                <span class="px-2 py-1 text-xs rounded inline-block mt-1
                                    @if($certificate->status === 'issued') bg-green-100 text-green-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($certificate->status) }}
                                </span>
                            </div>
                        </div>

                        @if($certificate->remarks)
                            <div class="mt-6 p-3 bg-gray-50 rounded text-sm text-gray-600">
                                <span class="font-medium text-gray-700">Remarks:</span> {{ $certificate->remarks }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
