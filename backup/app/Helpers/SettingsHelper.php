<?php

use App\Models\CompanySetting;

if (! function_exists('setting')) {
    function setting(?string $key = null)
    {
        static $settings = null;
        if ($settings === null) {
            $settings = CompanySetting::getSettings();
        }

        return $key ? ($settings->$key ?? null) : $settings;
    }
}
