<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Ghulam Ali Balti',
                'designation' => 'Lead Expedition Leader & Founder',
                'bio' => 'With 4 summits of 8,000m peaks including K2 and Broad Peak, Ghulam is one of Pakistan\'s most respected high-altitude climbers.',
                'photo' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Samina Karim',
                'designation' => 'Head of Trekking Logistics',
                'bio' => 'Pioneer female mountain guide from Hunza Valley with over 15 years leading cultural and trekking expeditions across the North.',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Zulfiqar Hussain',
                'designation' => 'High-Altitude Medical Advisor',
                'bio' => 'Specialist in wilderness and high-altitude emergency medicine ensuring all expedition health protocols meet UIAA standards.',
                'photo' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?auto=format&fit=crop&w=400&q=80',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(['name' => $member['name']], $member);
        }
    }
}
