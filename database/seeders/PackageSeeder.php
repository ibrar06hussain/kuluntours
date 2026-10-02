<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Package;
use App\Models\PackageImage;
use App\Models\PackageInclusion;
use App\Models\PackageItinerary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $trekking = Category::where('slug', 'trekking')->first();
        $expeditions = Category::where('slug', 'expeditions')->first();
        $rockClimbing = Category::where('slug', 'rock-climbing')->first();
        $easyTreks = Category::where('slug', 'easy-treks')->first();
        $tours = Category::where('slug', 'tours')->first();

        $packages = [
            [
                'category_id' => $trekking ? $trekking->id : 1,
                'title' => 'K2 Base Camp & Concordia Trek',
                'slug' => 'k2-base-camp-concordia-trek',
                'short_description' => 'The Throne Room of the Mountain Gods — trek the legendary Baltoro Glacier surrounded by four 8,000-meter peaks.',
                'description' => '<p>The K2 Base Camp & Concordia trek is universally acclaimed as one of the greatest mountain treks on Planet Earth. Traversing the mighty Baltoro Glacier, you will witness four of the world’s fourteen 8,000-meter peaks: K2 (8,611m), Broad Peak (8,047m), Gasherbrum I (8,080m), and Gasherbrum II (8,035m).</p><p>Standing at Concordia, surrounded by sheer granite cathedrals and giant ice giants, is an emotional and spiritual pinnacle for any true adventurer.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80',
                'duration_days' => 21,
                'price' => 680000.00,
                'price_note' => 'Per Person (All Inclusive)',
                'difficulty_level' => 'difficult',
                'max_altitude' => '5,150m (Base Camp) / 5,650m (Gondogoro La)',
                'best_season' => 'June to September',
                'starting_point' => 'Islamabad / Skardu',
                'ending_point' => 'Islamabad',
                'group_size' => '4 - 12 persons',
                'is_featured' => true,
                'is_fixed_departure' => true,
                'departure_date' => '2026-07-01',
                'sort_order' => 1,
                'is_active' => true,
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival in Islamabad', 'description' => 'Airport pickup, transfer to hotel, briefing at Alpine Club of Pakistan and document verification.'],
                    ['day_number' => 2, 'title' => 'Fly to Skardu (or Drive Karakoram Highway)', 'description' => 'Spectacular scenic flight past Nanga Parbat to Skardu (weather permitting) or drive via KKH.'],
                    ['day_number' => 3, 'title' => 'Skardu Prep & Acclimatization', 'description' => 'Final gear check, acclimatization hike to Kharpocho Fort and stroll through local bazaar.'],
                    ['day_number' => 4, 'title' => 'Drive Skardu to Askole / Jhola', 'description' => '4x4 Jeep ride through Shigar valley to the roadhead at Askole / Jhola camp.'],
                    ['day_number' => 5, 'title' => 'Trek to Paiju', 'description' => 'Trek along Braldu river towards the base of Paiju Peak with initial views of Baltoro glacier.'],
                    ['day_number' => 6, 'title' => 'Rest & Acclimatization Day at Paiju', 'description' => 'Rest day for trekkers and porters before stepping onto the massive Baltoro Glacier.'],
                    ['day_number' => 7, 'title' => 'Paiju to Khoburtse', 'description' => 'Climb onto the snout of the Baltoro Glacier with vistas of Trango Towers and Cathedral Peaks.'],
                    ['day_number' => 8, 'title' => 'Khoburtse to Urdukas', 'description' => 'Trek along glacier moraine with breathtaking views of the Nameless Tower and Great Trango.'],
                    ['day_number' => 9, 'title' => 'Urdukas to Goro II', 'description' => 'Trek up the center of the glacier past Masherbrum (7,821m) to Goro II.'],
                    ['day_number' => 10, 'title' => 'Goro II to Concordia', 'description' => 'Arrival at Concordia - the 360-degree panoramic sanctuary facing K2, Broad Peak, and Gasherbrum.'],
                    ['day_number' => 11, 'title' => 'Excursion to K2 Base Camp & Gilkey Memorial', 'description' => 'Early morning push to K2 Base Camp and pay homage at the historic Art Gilkey memorial.'],
                    ['day_number' => 12, 'title' => 'Concordia to Ali Camp via Vigne Glacier', 'description' => 'Trek towards Ali Camp in preparation for the high Gondogoro La pass crossing.'],
                    ['day_number' => 13, 'title' => 'Cross Gondogoro La (5,650m) to Hushe', 'description' => 'Midnight start for the summit push of Gondogoro La pass with dawn views of 4 8000m peaks, descend to Khuspang.'],
                    ['day_number' => 14, 'title' => 'Khuspang to Saicho', 'description' => 'Pleasant descent through lush pastureland with views of Laila Peak.'],
                    ['day_number' => 15, 'title' => 'Saicho to Hushe & Drive to Skardu', 'description' => 'Short trek to Hushe village, board 4x4 jeeps and return to comfortable hotel in Skardu.'],
                    ['day_number' => 16, 'title' => 'Fly Skardu to Islamabad / Contingency Day', 'description' => 'Fly back to Islamabad. Evening celebratory farewell dinner.'],
                ],
                'inclusions' => [
                    ['description' => 'All airport transfers and ground transport in private 4x4 Jeeps / Coaster', 'type' => 'inclusion'],
                    ['description' => '3-star & 4-star hotel accommodations on twin-sharing basis in cities', 'type' => 'inclusion'],
                    ['description' => 'High quality expedition-grade dome tents, mess tent, toilet tents', 'type' => 'inclusion'],
                    ['description' => 'Three freshly prepared nutritious hot meals daily on trek by certified mountain chef', 'type' => 'inclusion'],
                    ['description' => 'Licensed and experienced high-altitude English-speaking mountain guide', 'type' => 'inclusion'],
                    ['description' => 'Porters to carry up to 15kg personal luggage per client', 'type' => 'inclusion'],
                    ['description' => 'Trekking permits, Central Karakoram National Park fees, and environmental clearance', 'type' => 'inclusion'],
                    ['description' => 'Emergency medical kit, high-altitude hyperbaric bag (Gamow) and pulse oximeters', 'type' => 'inclusion'],
                    ['description' => 'Satellite communication and GPS tracking safety coverage', 'type' => 'inclusion'],
                    ['description' => 'International flights to/from Pakistan', 'type' => 'exclusion'],
                    ['description' => 'Pakistan visa fees and travel/rescue insurance (mandatory)', 'type' => 'exclusion'],
                    ['description' => 'Personal climbing / trekking equipment (boots, crampons, sleeping bag)', 'type' => 'exclusion'],
                    ['description' => 'Tips for guides, porters, and kitchen crew', 'type' => 'exclusion'],
                    ['description' => 'Alcoholic beverages and personal soft drinks/snacks', 'type' => 'exclusion'],
                ],
            ],
            [
                'category_id' => $expeditions ? $expeditions->id : 2,
                'title' => 'Spantik Peak (Golden Peak) 7027m Expedition',
                'slug' => 'spantik-peak-7027m-expedition',
                'short_description' => 'The Perfect First 7,000-Meter Karakoram Summit — non-technical classic snow climbing with breathtaking ridge views.',
                'description' => '<p>Spantik, also known as the Golden Peak, stands at 7,027 meters in the Spantik-Sosbun Mountains of the Karakoram range. It is one of the most accessible and popular 7,000m peaks in the world, making it the ideal training ground for ambitious mountaineers preparing for an 8,000m giant like Broad Peak or Everest.</p><p>The Southeast Ridge route offers classic, non-technical snow and ice climbing with moderate glacier slopes and a spectacular summit ridge overlook.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80',
                'duration_days' => 30,
                'price' => 1100000.00,
                'price_note' => 'Expedition Package',
                'difficulty_level' => 'difficult',
                'max_altitude' => '7,027m',
                'best_season' => 'June to August',
                'starting_point' => 'Islamabad',
                'ending_point' => 'Islamabad',
                'group_size' => '4 - 10 climbers',
                'is_featured' => true,
                'is_fixed_departure' => true,
                'departure_date' => '2026-07-15',
                'sort_order' => 2,
                'is_active' => true,
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival Islamabad', 'description' => 'Briefing with Alpine Club and government liaisons.'],
                    ['day_number' => 2, 'title' => 'Drive / Fly to Skardu', 'description' => 'Flight to Skardu or drive scenic Karakoram Highway.'],
                    ['day_number' => 3, 'title' => 'Drive to Arandu Village', 'description' => 'Jeep journey to the historic village of Arandu, the final settlement.'],
                    ['day_number' => 4, 'title' => 'Trek to Chogo Lungma Glacier Base Camp', 'description' => 'Trek along glacier moraines to establish base camp at 4,300m.'],
                    ['day_number' => 5, 'title' => 'Climbing Period (Camp 1, Camp 2, Camp 3 & Summit)', 'description' => 'Acclimatization rotations, fixing ropes on Southeast ridge, establish high camps, summit bid at 7,027m.'],
                    ['day_number' => 25, 'title' => 'Base Camp Cleanup & Return Trek', 'description' => 'Leave no trace cleanup and trek back to Arandu village.'],
                    ['day_number' => 28, 'title' => 'Return to Islamabad', 'description' => 'Debriefing at Ministry of Tourism and farewell banquet.'],
                ],
                'inclusions' => [
                    ['description' => 'Official government mountaineering royalty permit & liaison officer allowance', 'type' => 'inclusion'],
                    ['description' => 'Complete base camp infrastructure (mess, kitchen, member tents, solar power)', 'type' => 'inclusion'],
                    ['description' => 'High-altitude tents, climbing ropes, snow bars, and ice screws', 'type' => 'inclusion'],
                    ['description' => 'High altitude climbing Sherpa/Guide support', 'type' => 'inclusion'],
                    ['description' => 'Personal climbing gear (crampons, harness, ice axe, down suit)', 'type' => 'exclusion'],
                    ['description' => 'Emergency helicopter evacuation insurance', 'type' => 'exclusion'],
                ],
            ],
            [
                'category_id' => $easyTreks ? $easyTreks->id : 4,
                'title' => 'Fairy Meadows & Nanga Parbat Base Camp Trek',
                'slug' => 'fairy-meadows-nanga-parbat-base-camp',
                'short_description' => 'Enchanting Alpine Meadows Beneath the Killer Mountain — reflection pools, pine forests, and colossal glacial faces.',
                'description' => '<p>Fairy Meadows, locally known as Joot, is a serene lush plateau at 3,300 meters right at the foot of Nanga Parbat (8,126m) — the 9th highest mountain in the world and the western anchor of the Great Himalayas.</p><p>Surrounded by dense pine forests, reflection lakes, and the colossal Raikot Glacier, this trek offers a manageable yet exhilarating adventure suitable for nature enthusiasts and beginners.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=80',
                'duration_days' => 8,
                'price' => 235000.00,
                'price_note' => 'Per Person',
                'difficulty_level' => 'moderate',
                'max_altitude' => '3,967m (Beyal / Base Camp)',
                'best_season' => 'May to October',
                'starting_point' => 'Islamabad',
                'ending_point' => 'Islamabad',
                'group_size' => '2 - 16 persons',
                'is_featured' => true,
                'is_fixed_departure' => false,
                'departure_date' => null,
                'sort_order' => 3,
                'is_active' => true,
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Islamabad to Chilas / Naran', 'description' => 'Scenic drive through Babusar Pass (4,173m) to Chilas.'],
                    ['day_number' => 2, 'title' => 'Raikot Bridge to Fairy Meadows', 'description' => 'Thrill 4x4 Jeep ride along the world-famous cliffside track to Tattu village, followed by 3-hour walk through alpine pine forest to Fairy Meadows.'],
                    ['day_number' => 3, 'title' => 'Day Hike to Beyal Camp & Nanga Parbat Viewpoint', 'description' => 'Walk through birch woods to Beyal Camp and onward to the edge of the Raikot Glacier with the colossal North Face of Nanga Parbat filling the sky.'],
                    ['day_number' => 4, 'title' => 'Trek to Nanga Parbat Base Camp (3,967m)', 'description' => 'Full day excursion to the German Climbers Memorial Base Camp and return to Fairy Meadows.'],
                    ['day_number' => 5, 'title' => 'Fairy Meadows to Hunza Valley', 'description' => 'Descend to Raikot Bridge and drive along Karakoram Highway past Rakaposhi viewpoint to Karimabad, Hunza.'],
                    ['day_number' => 6, 'title' => 'Hunza Sightseeing (Baltit & Altit Forts, Attabad Lake)', 'description' => 'Explore ancient forts, turquoise Attabad Lake boat ride, and Passu Cones.'],
                    ['day_number' => 7, 'title' => 'Drive back to Besham / Naran', 'description' => 'Scenic return drive along Indus River.'],
                    ['day_number' => 8, 'title' => 'Besham to Islamabad & Departure', 'description' => 'Transfer to Islamabad International Airport for onward departure.'],
                ],
                'inclusions' => [
                    ['description' => 'Air-conditioned luxury coaster / Prado transport throughout', 'type' => 'inclusion'],
                    ['description' => 'Raikot 4x4 Mountain Jeeps to Tattu and return', 'type' => 'inclusion'],
                    ['description' => 'Cozy wooden cottage stays at Fairy Meadows with heating', 'type' => 'inclusion'],
                    ['description' => 'All entry tickets to Baltit & Altit Forts and national parks', 'type' => 'inclusion'],
                    ['description' => 'Expert local trekking guide and porters for luggage', 'type' => 'inclusion'],
                    ['description' => 'Daily fresh breakfasts and dinners', 'type' => 'inclusion'],
                    ['description' => 'Personal horse/pony riding fees (optional)', 'type' => 'exclusion'],
                    ['description' => 'Tips and personal expenses', 'type' => 'exclusion'],
                ],
            ],
            [
                'category_id' => $tours ? $tours->id : 5,
                'title' => 'Hunza & Skardu Valley Grand Tour',
                'slug' => 'hunza-skardu-valley-grand-tour',
                'short_description' => 'A Majestic Cultural & Landscape Odyssey Across Northern Pakistan — Forts, crystal lakes, cold deserts, and Deosai plateau.',
                'description' => '<p>Immerse yourself in the timeless magic of the Karakoram. This grand tour combines the legendary Shangri-La of Hunza Valley with the majestic deserts, lakes, and waterfalls of Skardu and Deosai National Park — the second highest alpine plateau on Earth.</p><p>Ideal for families, photographers, and luxury travelers seeking culture, hospitality, and awe-inspiring sights without strenuous trekking.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1486870591958-9b9d0d1dda99?auto=format&fit=crop&w=1200&q=80',
                'duration_days' => 12,
                'price' => 375000.00,
                'price_note' => 'Per Person (Twin Sharing)',
                'difficulty_level' => 'easy',
                'max_altitude' => '4,114m (Deosai Plateau)',
                'best_season' => 'April to November',
                'starting_point' => 'Islamabad',
                'ending_point' => 'Islamabad',
                'group_size' => '2 - 20 persons',
                'is_featured' => true,
                'is_fixed_departure' => false,
                'departure_date' => null,
                'sort_order' => 4,
                'is_active' => true,
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival Islamabad & City Tour', 'description' => 'Faisal Mosque, Pakistan Monument, and welcome dinner in Margalla Hills.'],
                    ['day_number' => 2, 'title' => 'Islamabad to Gilgit / Chilas', 'description' => 'Fly to Gilgit or scenic luxury drive through Babusar valley.'],
                    ['day_number' => 3, 'title' => 'Gilgit to Karimabad Hunza', 'description' => 'Stop at Junction point of 3 Great Mountain Ranges and Rakaposhi viewpoint.'],
                    ['day_number' => 4, 'title' => 'Upper Hunza & Khunjerab Pass (Pak-China Border)', 'description' => 'Visit Attabad Lake, Hussaini Suspension Bridge, Passu Cones, and world’s highest paved border at 4,693m.'],
                    ['day_number' => 5, 'title' => 'Hunza Heritage & Eagles Nest Sunset', 'description' => 'Tour of 900-year-old Altit Fort and 700-year-old Baltit Fort. Sunset at Duikar.'],
                    ['day_number' => 6, 'title' => 'Hunza to Skardu via Karakoram Highway', 'description' => 'Dramatic drive along the confluence of Indus and Gilgit Rivers to Skardu.'],
                    ['day_number' => 7, 'title' => 'Upper Kachura Lake & Shangrila Resort', 'description' => 'Boating on crystal clear Upper Kachura Lake and visit Lower Kachura resort.'],
                    ['day_number' => 8, 'title' => 'Cold Desert of Sarfaranga & Shigar Fort', 'description' => 'Visit highest cold desert in the world with optional quad biking, tour Serena Shigar Fort.'],
                    ['day_number' => 9, 'title' => 'Deosai National Park & Sheosar Lake', 'description' => 'Excursion to the Land of Giants (4,100m) with brown bear habitat and emerald Sheosar Lake.'],
                    ['day_number' => 10, 'title' => 'Manthokha Waterfall & Khaplu Palace', 'description' => 'Visit roaring Manthokha waterfall and 400-year-old Raja Palace in Khaplu.'],
                    ['day_number' => 11, 'title' => 'Fly Skardu to Islamabad', 'description' => 'Morning flight over Nanga Parbat to Islamabad. Free evening shopping in Islamabad.'],
                    ['day_number' => 12, 'title' => 'International Departure', 'description' => 'Airport transfer for your journey home.'],
                ],
                'inclusions' => [
                    ['description' => 'All luxury hotel and boutique heritage fort stays', 'type' => 'inclusion'],
                    ['description' => 'Dedicated air-conditioned VIP vehicle + 4x4 Prado for Deosai', 'type' => 'inclusion'],
                    ['description' => 'All monument, fort, and national park entrance fees', 'type' => 'inclusion'],
                    ['description' => 'Full-board gourmet dining throughout', 'type' => 'inclusion'],
                    ['description' => 'English-speaking professional cultural guide', 'type' => 'inclusion'],
                    ['description' => 'International airfare', 'type' => 'exclusion'],
                    ['description' => 'Personal shopping and optional activities (jet ski, quad biking)', 'type' => 'exclusion'],
                ],
            ],
            [
                'category_id' => $rockClimbing ? $rockClimbing->id : 3,
                'title' => 'Trango Towers (Nameless Tower) Climbing Expedition',
                'slug' => 'trango-towers-climbing-expedition',
                'short_description' => 'The Holy Grail of Big Wall Rock Climbing on Earth — sheer 1,000-meter vertical granite spires in the heart of Karakoram.',
                'description' => '<p>Rising vertically above the Baltoro Glacier, the granite monoliths of the Trango group offer the biggest vertical rock cliffs on the planet. The Nameless Tower (6,239m) and Great Trango Tower (6,286m) present sheer 1,000-meter vertical and overhanging granite walls that represent the ultimate trophy for world-class big wall climbers.</p><p>Kunlun Treks & Tours provides elite base camp support, rope rigging, high-altitude porters, and logistical mastery for private expeditions.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                'duration_days' => 35,
                'price' => 1450000.00,
                'price_note' => 'Private Big Wall Logistics',
                'difficulty_level' => 'extreme',
                'max_altitude' => '6,239m',
                'best_season' => 'June to August',
                'starting_point' => 'Islamabad',
                'ending_point' => 'Islamabad',
                'group_size' => '2 - 6 climbers',
                'is_featured' => false,
                'is_fixed_departure' => false,
                'departure_date' => null,
                'sort_order' => 5,
                'is_active' => true,
                'itineraries' => [
                    ['day_number' => 1, 'title' => 'Arrival Islamabad', 'description' => 'Expedition briefing and equipment inspection.'],
                    ['day_number' => 2, 'title' => 'Islamabad to Skardu', 'description' => 'Flight or overland journey.'],
                    ['day_number' => 5, 'title' => 'Trek to Trango Base Camp (4,100m)', 'description' => 'Establish base camp beneath the towering granite spires of Trango.'],
                    ['day_number' => 6, 'title' => 'Big Wall Climbing Period (Days 6 - 28)', 'description' => 'Portaledge wall camping, aid and free climbing on flawless granite.'],
                    ['day_number' => 32, 'title' => 'Descend to Askole & Drive Skardu', 'description' => 'Pack out base camp and return to Skardu.'],
                    ['day_number' => 35, 'title' => 'Islamabad Departure', 'description' => 'Final debriefing and flight home.'],
                ],
                'inclusions' => [
                    ['description' => 'Full climbing permit processing and liaison officer fees', 'type' => 'inclusion'],
                    ['description' => 'Base camp deluxe setup with generator power and dining dome', 'type' => 'inclusion'],
                    ['description' => 'Porters to and from Base Camp with all heavy hardware and ropes', 'type' => 'inclusion'],
                    ['description' => 'Personal portaledges and dynamic climbing ropes', 'type' => 'exclusion'],
                    ['description' => 'Helicopter rescue deposit/insurance', 'type' => 'exclusion'],
                ],
            ],
        ];

        foreach ($packages as $pkgData) {
            $itineraries = $pkgData['itineraries'] ?? [];
            $inclusions = $pkgData['inclusions'] ?? [];
            unset($pkgData['itineraries'], $pkgData['inclusions']);

            $pkg = Package::updateOrCreate(
                ['slug' => $pkgData['slug']],
                array_merge($pkgData, [
                    'meta_title' => $pkgData['title'] . ' | Kunlun Treks and Tours',
                    'meta_description' => Str::limit(strip_tags($pkgData['short_description']), 155),
                ])
            );

            // Add gallery images
            PackageImage::where('package_id', $pkg->id)->delete();
            $sampleImages = [
                'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=80',
            ];
            foreach ($sampleImages as $idx => $img) {
                PackageImage::create([
                    'package_id' => $pkg->id,
                    'image' => $img,
                    'caption' => $pkg->title . ' - View ' . ($idx + 1),
                    'sort_order' => $idx + 1,
                ]);
            }

            // Add itineraries
            PackageItinerary::where('package_id', $pkg->id)->delete();
            foreach ($itineraries as $idx => $itn) {
                PackageItinerary::create(array_merge($itn, [
                    'package_id' => $pkg->id,
                    'sort_order' => $idx + 1,
                ]));
            }

            // Add inclusions/exclusions
            PackageInclusion::where('package_id', $pkg->id)->delete();
            foreach ($inclusions as $idx => $inc) {
                PackageInclusion::create(array_merge($inc, [
                    'package_id' => $pkg->id,
                    'sort_order' => $idx + 1,
                ]));
            }
        }
    }
}
