<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Kunlun Treks and Tours',
            'site_tagline' => 'Adventure Beyond Boundaries',
            'phone' => '+92-XXX-XXXXXXX',
            'phone_2' => '+92-XXX-XXXXXXX',
            'email' => 'info@kunluntreks.com',
            'address' => 'Skardu, Gilgit-Baltistan, Pakistan',
            'whatsapp_number' => '+92XXXXXXXXXX',
            'logo' => null,
            'favicon' => null,
            'footer_text' => '© ' . date('Y') . ' Kunlun Treks and Tours. All Rights Reserved.',
            'google_analytics' => null,
            'meta_title' => 'Kunlun Treks and Tours - Adventure Travel in Pakistan',
            'meta_description' => 'Explore Pakistan\'s majestic mountains with Kunlun Treks and Tours. Expert-guided trekking, expeditions, rock climbing, and cultural tours in Karakoram, Himalaya, and Hindukush.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
