<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'platform' => 'Facebook',
                'url' => 'https://facebook.com/kunluntreks',
                'icon_class' => 'fab fa-facebook-f',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'platform' => 'Instagram',
                'url' => 'https://instagram.com/kunluntreks',
                'icon_class' => 'fab fa-instagram',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'platform' => 'YouTube',
                'url' => 'https://youtube.com/@kunluntreks',
                'icon_class' => 'fab fa-youtube',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'platform' => 'TripAdvisor',
                'url' => 'https://tripadvisor.com',
                'icon_class' => 'fab fa-tripadvisor',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'platform' => 'WhatsApp',
                'url' => 'https://wa.me/923000000000',
                'icon_class' => 'fab fa-whatsapp',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], $link);
        }
    }
}
