<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Trekking',
                'slug' => 'trekking',
                'description' => 'Explore the most spectacular trekking routes through the Karakoram, Himalaya, and Hindukush mountain ranges.',
                'icon_class' => 'fas fa-hiking',
                'sort_order' => 1,
            ],
            [
                'name' => 'Expeditions',
                'slug' => 'expeditions',
                'description' => 'Summit the world\'s highest peaks with our expert-guided mountaineering expeditions.',
                'icon_class' => 'fas fa-mountain',
                'sort_order' => 2,
            ],
            [
                'name' => 'Rock Climbing',
                'slug' => 'rock-climbing',
                'description' => 'Challenge yourself on the legendary granite spires and rock faces of the Karakoram.',
                'icon_class' => 'fas fa-person-falling',
                'sort_order' => 3,
            ],
            [
                'name' => 'Easy Treks',
                'slug' => 'easy-treks',
                'description' => 'Gentle treks perfect for beginners and families seeking breathtaking mountain scenery.',
                'icon_class' => 'fas fa-shoe-prints',
                'sort_order' => 4,
            ],
            [
                'name' => 'Tours',
                'slug' => 'tours',
                'description' => 'Cultural and sightseeing tours showcasing Pakistan\'s rich heritage and natural beauty.',
                'icon_class' => 'fas fa-bus',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                array_merge($category, [
                    'is_active' => true,
                    'show_in_menu' => true,
                    'meta_title' => $category['name'] . ' - Kunlun Treks and Tours',
                    'meta_description' => $category['description'],
                ])
            );
        }
    }
}
