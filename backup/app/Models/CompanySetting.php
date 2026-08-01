<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'company_name', 'company_name_bn', 'tagline', 'logo', 'favicon',
        'mobile', 'email', 'website', 'address', 'address_bn',
        'facebook_url', 'youtube_url', 'whatsapp_number', 'linkedin_url',
        'primary_color', 'footer_text', 'copyright_text',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    public static function getSettings(): self
    {
        return self::first() ?? new self;
    }
}
