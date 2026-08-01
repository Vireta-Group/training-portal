<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Issue New Certificate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('certificates.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="student_id" value="Student *" />
                            <select id="student_id" name="student_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">— Select Student —</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name_en }} ({{ $student->reference_no }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="issue_date" value="Issue Date *" />
                            <x-text-input id="issue_date" class="block mt-1 w-full" type="date" name="issue_date" :value="old('issue_date')" required />
                            <x-input-error :messages="$errors->get('issue_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="template" value="Template" />
                            <select id="template" name="template" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="default" {{ old('template') == 'default' ? 'selected' : '' }}>Default</option>
                            </select>
                            <x-input-error :messages="$errors->get('template')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="remarks" value="Remarks" />
                            <textarea id="remarks" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="remarks" rows="3">{{ old('remarks') }}</textarea>
                            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-3">
                            <a href="{{ route('certificates.index') }}" class="btn btn-outline-gray">Cancel</a>
                            <button type="submit" class="btn btn-solid-emerald">Issue Certificate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
