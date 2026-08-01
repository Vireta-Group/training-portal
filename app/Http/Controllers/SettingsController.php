<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $setting = CompanySetting::getSettings();

        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_name_bn' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'address_bn' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'primary_color' => 'nullable|string|max:7',
            'footer_text' => 'nullable|string',
            'copyright_text' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }
        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
        }

        $setting = CompanySetting::getSettings();

        if ($setting->exists) {
            $setting->update($data);
        } else {
            $setting = CompanySetting::create($data);
        }

        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully.');
    }
}
