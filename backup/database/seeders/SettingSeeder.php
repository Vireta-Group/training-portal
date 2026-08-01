<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        if (CompanySetting::count() > 0) {
            return;
        }

        CompanySetting::create([
            'company_name' => 'TrainingPro',
            'company_name_bn' => 'TrainingPro',
            'tagline' => 'Empowering Skills, Building Futures',
            'mobile' => '01700-000000',
            'email' => 'info@trainingpro.com',
            'website' => 'https://trainingpro.com',
            'address' => 'House-12, Road-5, Block-C, Mirpur-12, Dhaka-1216',
            'address_bn' => 'House-12, Road-5, Block-C, Mirpur-12, Dhaka-1216',
            'facebook_url' => 'https://facebook.com/trainingpro',
            'youtube_url' => 'https://youtube.com/@trainingpro',
            'whatsapp_number' => '01700-000000',
            'primary_color' => '#6366f1',
            'footer_text' => 'TrainingPro — Bridging the gap between education and employment.',
            'copyright_text' => '© '.date('Y').' TrainingPro. All rights reserved.',
            'meta_title' => 'TrainingPro — Professional Training & Skill Development',
            'meta_description' => 'Bangladesh\'s leading training platform. Enroll in professional courses and build your career with industry-recognized certificates.',
            'meta_keywords' => 'training, skill development, professional courses, Bangladesh, certificate, career',
        ]);
    }
}
