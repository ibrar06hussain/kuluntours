<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $posts = [
            [
                'author_id' => $admin ? $admin->id : 1,
                'title' => 'Ultimate Packing Guide for the K2 Base Camp Trek',
                'slug' => 'ultimate-packing-guide-k2-base-camp-trek',
                'excerpt' => 'Discover the essential clothing layers, mountaineering boots, sleeping bags, and medical gear you need for 21 days on the Baltoro Glacier.',
                'content' => '<p>Packing for the K2 Base Camp trek requires balancing lightweight packing with extreme mountain weather preparedness. Temperatures on the Baltoro glacier can swing from +25°C under the blazing sun to -15°C inside your tent at night at Concordia.</p><h3>The 3-Layer System</h3><p>Always rely on a high-wicking synthetic or merino wool base layer, insulating fleece or down mid-layer, and a rugged Gore-Tex waterproof outer shell.</p><h3>Footwear Matters</h3><p>Your trekking boots should be rigid, waterproof, well broken-in, with aggressive Vibram soles.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80',
                'meta_title' => 'K2 Base Camp Trek Packing Guide | Kunlun Treks',
                'meta_description' => 'Comprehensive packing list and gear guide for trekking the Baltoro Glacier and Concordia to K2.',
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'author_id' => $admin ? $admin->id : 1,
                'title' => 'Why Northern Pakistan is the Next Great Mountaineering Frontier',
                'slug' => 'why-northern-pakistan-mountaineering-frontier',
                'excerpt' => 'With 5 of the 14 eight-thousanders and thousands of unclimbed peaks, Pakistan offers untouched alpine glory.',
                'content' => '<p>While the Himalayas in Nepal have become increasingly commercialized, the Karakoram and Hindukush ranges of Pakistan still offer pure, uncrowded wilderness. Here, you hike for weeks seeing only soaring granite cathedrals, vast glacier systems, and authentic mountain cultures.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80',
                'meta_title' => 'Northern Pakistan Mountaineering Frontier | Kunlun Treks',
                'meta_description' => 'Explore why Karakoram in Pakistan is the purest high-altitude adventure destination in the world.',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
