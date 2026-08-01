<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Exam') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('exams.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="batch_id" value="Batch *" />
                            <select id="batch_id" name="batch_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">— Select Batch —</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->name }} — {{ $batch->course?->name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('batch_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="name" value="Exam Name (English) *" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="name_bn" value="Exam Name (Bangla)" />
                            <x-text-input id="name_bn" class="block mt-1 w-full" type="text" name="name_bn" :value="old('name_bn')" />
                            <x-input-error :messages="$errors->get('name_bn')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type" value="Exam Type *" />
                            <select id="type" name="type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">— Select Type —</option>
                                <option value="quiz" {{ old('type') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                                <option value="midterm" {{ old('type') == 'midterm' ? 'selected' : '' }}>Midterm</option>
                                <option value="final" {{ old('type') == 'final' ? 'selected' : '' }}>Final</option>
                                <option value="model_test" {{ old('type') == 'model_test' ? 'selected' : '' }}>Model Test</option>
                                <option value="retake" {{ old('type') == 'retake' ? 'selected' : '' }}>Retake</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="exam_date" value="Exam Date *" />
                            <x-text-input id="exam_date" class="block mt-1 w-full" type="date" name="exam_date" :value="old('exam_date')" required />
                            <x-input-error :messages="$errors->get('exam_date')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="total_marks" value="Total Marks *" />
                                <x-text-input id="total_marks" class="block mt-1 w-full" type="number" name="total_marks" :value="old('total_marks')" min="1" step="any" required />
                                <x-input-error :messages="$errors->get('total_marks')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="passing_marks" value="Passing Marks *" />
                                <x-text-input id="passing_marks" class="block mt-1 w-full" type="number" name="passing_marks" :value="old('passing_marks')" min="0" step="any" required />
                                <x-input-error :messages="$errors->get('passing_marks')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="description" rows="3">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-3">
                            <a href="{{ route('exams.index') }}" class="btn btn-outline-gray">Cancel</a>
                            <button type="submit" class="btn btn-solid-emerald">Save Exam</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
