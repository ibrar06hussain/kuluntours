<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    /**
     * Get a setting value by key with caching.
     */
    public function get(string $key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            return SiteSetting::get($key, $default);
        });
    }

    /**
     * Set a setting value and clear cache.
     */
    public function set(string $key, $value): void
    {
        SiteSetting::set($key, $value);
        Cache::forget("setting.{$key}");
        Cache::forget('settings.all');
    }

    /**
     * Get all settings as key-value array.
     */
    public function all(): array
    {
        return Cache::remember('settings.all', 3600, function () {
            return SiteSetting::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Clear all settings cache.
     */
    public function clearCache(): void
    {
        $settings = SiteSetting::all();
        foreach ($settings as $setting) {
            Cache::forget("setting.{$setting->key}");
        }
        Cache::forget('settings.all');
    }
}
