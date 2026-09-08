<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Alexander Schmidt',
                'designation' => 'Mountaineer',
                'company' => 'Germany',
                'content' => 'Trekking to Concordia with Kunlun Treks was the pinnacle of my 20-year hiking life. The guides were exceptionally skilled, food in the high camps was hot and delicious, and the safety measures gave us supreme confidence.',
                'rating' => 5,
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'Claire & Thomas Davies',
                'designation' => 'Adventure Travelers',
                'company' => 'United Kingdom',
                'content' => 'We were blown away by the hospitality, dramatic mountain panoramas, and luxury heritage stays in Khaplu and Shigar. Kunlun Treks handled every detail seamlessly. Best trip of our lives!',
                'rating' => 5,
                'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'Hiroshi Tanaka',
                'designation' => 'Climber',
                'company' => 'Japan',
                'content' => 'Our summit bid on Spantik was successful thanks to the unmatched expertise of our high-altitude guides. Their knowledge of Karakoram weather patterns and rope rigging is world class.',
                'rating' => 5,
                'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(['client_name' => $testimonial['client_name']], $testimonial);
        }
    }
}
