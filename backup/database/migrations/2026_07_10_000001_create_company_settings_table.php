<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_name_bn')->nullable();
            $table->string('tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->text('address_bn')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('primary_color')->default('#6366f1');
            $table->text('footer_text')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });

        DB::table('company_settings')->insert([
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
