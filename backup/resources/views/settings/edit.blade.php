@php
    $setting = App\Models\CompanySetting::getSettings();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-6">
                    <h3 class="text-lg font-medium border-b pb-2">General</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Company Name (EN)</label>
                            <input type="text" name="company_name" value="{{ old('company_name', $setting->company_name) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                            @error('company_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Company Name (BN)</label>
                            <input type="text" name="company_name_bn" value="{{ old('company_name_bn', $setting->company_name_bn) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tagline</label>
                            <input type="text" name="tagline" value="{{ old('tagline', $setting->tagline) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Primary Color</label>
                            <input type="color" name="primary_color" value="{{ old('primary_color', $setting->primary_color ?? '#6366f1') }}"
                                   class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                    </div>

                    <h3 class="text-lg font-bold border-b pb-2 mt-6">Contact Info</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile', $setting->mobile) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $setting->email) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Website</label>
                            <input type="url" name="website" value="{{ old('website', $setting->website) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">WhatsApp Number</label>
                            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address (EN)</label>
                        <textarea name="address" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">{{ old('address', $setting->address) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address (BN)</label>
                        <textarea name="address_bn" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">{{ old('address_bn', $setting->address_bn) }}</textarea>
                    </div>

                    <h3 class="text-lg font-bold border-b pb-2 mt-6">Social Links</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Facebook URL</label>
                            <input type="url" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">YouTube URL</label>
                            <input type="url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">LinkedIn URL</label>
                            <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                        </div>
                    </div>

                    <h3 class="text-lg font-bold border-b pb-2 mt-6">Logo & Favicon</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Logo</label>
                            @if($setting->logo)
                                <img src="{{ Storage::url($setting->logo) }}" class="h-12 mb-2" alt="Logo">
                            @endif
                            <input type="file" name="logo" accept="image/png,image/jpeg"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Favicon</label>
                            @if($setting->favicon)
                                <img src="{{ Storage::url($setting->favicon) }}" class="block h-8 mb-2" alt="Favicon">
                            @endif
                            <input type="file" name="favicon" accept="image/x-icon,image/png"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                    </div>

                    <h3 class="text-lg font-bold border-b pb-2 mt-6">Footer</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Footer Text</label>
                        <textarea name="footer_text" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">{{ old('footer_text', $setting->footer_text) }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Copyright Text</label>
                        <input type="text" name="copyright_text" value="{{ old('copyright_text', $setting->copyright_text) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                    </div>

                    <h3 class="text-lg font-bold border-b pb-2 mt-6">SEO</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $setting->meta_title) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">{{ old('meta_description', $setting->meta_description) }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $setting->meta_keywords) }}" placeholder="keyword1, keyword2"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t rounded-b-lg flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>