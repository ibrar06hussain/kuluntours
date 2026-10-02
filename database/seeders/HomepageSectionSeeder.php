<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'section_key' => 'about_intro',
                'title' => 'Welcome to Kunlun Treks and Tours',
                'subtitle' => 'Pioneers of Karakoram & Himalayan Mountaineering',
                'description' => '<p>Kunlun Treks and Tours is Pakistan’s premier mountain adventure travel operator headquartered in Skardu, Gilgit-Baltistan. Founded by seasoned high-altitude mountain guides and climbers, we craft unforgettable trekking expeditions, peak climbs, and cultural journeys through the Karakoram, Western Himalayas, and Hindukush ranges.</p><p>With over two decades of experience, safety-certified local guides, environmentally conscious operations, and unmatched local logistical expertise, we bring your dream Himalayan and Karakoram adventure to life.</p>',
                'image' => 'https://images.unsplash.com/photo-1486870591958-9b9d0d1dda99?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'section_key' => 'why_choose_us',
                'title' => 'Why Choose Kunlun Treks & Tours',
                'subtitle' => 'Experience, Safety & Local Mastery',
                'description' => '<div class="row g-4">
                    <div class="col-md-3 text-center"><i class="fas fa-shield-alt fa-3x text-warning mb-3"></i><h5 class="text-white fw-bold">100% Safety Track Record</h5><p class="text-light opacity-90 small">Certified high-altitude medical equipment, satellite comms, and rescue protocols on every trek.</p></div>
                    <div class="col-md-3 text-center"><i class="fas fa-user-tie fa-3x text-warning mb-3"></i><h5 class="text-white fw-bold">Veteran Local Guides</h5><p class="text-light opacity-90 small">Balti and Hunzai mountaineers who were born in these peaks and know every hidden pass.</p></div>
                    <div class="col-md-3 text-center"><i class="fas fa-leaf fa-3x text-warning mb-3"></i><h5 class="text-white fw-bold">Eco-Friendly & Sustainable</h5><p class="text-light opacity-90 small">Strict leave-no-trace ethics, fair wages for porters, and community-support initiatives.</p></div>
                    <div class="col-md-3 text-center"><i class="fas fa-star fa-3x text-warning mb-3"></i><h5 class="text-white fw-bold">Bespoke & Tailor-Made</h5><p class="text-light opacity-90 small">Customized itineraries designed around your fitness level, schedule, and climbing goals.</p></div>
                </div>',
                'image' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'section_key' => 'cta_banner',
                'title' => 'Ready for the Adventure of a Lifetime?',
                'subtitle' => 'Get in touch with our mountain specialists to customize your personalized itinerary.',
                'description' => '<p class="lead">From the base of K2 to the mystical meadows of Nanga Parbat, let our expedition leaders guide your path.</p>',
                'image' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1920&q=80',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            HomepageSection::updateOrCreate(['section_key' => $section['section_key']], $section);
        }
    }
}
