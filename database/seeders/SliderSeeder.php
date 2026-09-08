<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Conquer the Mighty Karakoram',
                'subtitle' => 'Legendary Treks & Expeditions to K2, Broad Peak & Beyond',
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Explore Treks',
                'button_url' => '/packages?category=trekking',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pure Wilderness & High Passes',
                'subtitle' => 'Traverse Gondogoro La & Witness 4 of 14 Eight-Thousanders',
                'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'View Expeditions',
                'button_url' => '/packages?category=expeditions',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Fairy Meadows & Nanga Parbat',
                'subtitle' => 'Magical landscapes under the shadow of the Killer Mountain',
                'image' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Plan Your Journey',
                'button_url' => '/contact',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::updateOrCreate(['title' => $slider['title']], $slider);
        }
    }
}
