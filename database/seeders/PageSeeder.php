<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => '<h2>The Spirit of Kunlun Treks and Tours</h2>
                <p>Rooted in the rugged heights of the Karakoram, Kunlun Treks and Tours was founded by native mountain climbers and cultural heritage guides of Gilgit-Baltistan. We stand as a beacon of high-altitude excellence, personalized expeditions, and sustainable mountain tourism.</p>
                <h3>Our Mission</h3>
                <p>To deliver safe, life-changing, and ethically operated adventures across Pakistan’s greatest peaks while empowering local mountain communities through fair employment, education, and environmental stewardship.</p>
                <h3>Our Heritage</h3>
                <p>Over two decades of guiding international climbers to summits including K2, Broad Peak, Spantik, and Gasherbrum II, our team combines local instinct with Swiss-grade safety standards.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1486870591958-9b9d0d1dda99?auto=format&fit=crop&w=1200&q=80',
                'meta_title' => 'About Us - Kunlun Treks and Tours',
                'meta_description' => 'Learn about Kunlun Treks and Tours, our founders, expedition track record, and ethical mountain philosophy in Pakistan.',
                'is_active' => true,
            ],
            [
                'title' => 'Pakistan Visa & Travel Information',
                'slug' => 'visa-information',
                'content' => '<h2>Obtaining Your Pakistan Tourist / Trekking e-Visa</h2>
                <p>Visiting Pakistan is now simpler than ever thanks to the Ministry of Interior online e-Visa portal. Most nationalities can apply online within minutes.</p>
                <h3>Requirements:</h3>
                <ul>
                    <li>Valid Passport (minimum 6 months validity from date of entry)</li>
                    <li>Passport size digital photograph with white background</li>
                    <li>Official Letter of Invitation (LOI) provided by Kunlun Treks and Tours</li>
                    <li>Tour itinerary and hotel booking confirmations</li>
                </ul>
                <p>For trekking and climbing in restricted/controlled zones (like the Baltoro Glacier), Kunlun Treks coordinates all mandatory security permits and liaison officer logistics.</p>',
                'featured_image' => null,
                'meta_title' => 'Pakistan Visa Information | Kunlun Treks and Tours',
                'meta_description' => 'Everything you need to know about getting your Pakistan tourist visa and trekking permits.',
                'is_active' => true,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'content' => '<h2>Booking Terms & Conditions</h2>
                <p>Please review our booking, deposit, cancellation, and insurance policies before confirming your expedition.</p>
                <h3>1. Deposit & Payment</h3>
                <p>A non-refundable deposit of 30% is required upon booking confirmation. The remaining balance must be paid 30 days prior to trip departure.</p>
                <h3>2. Travel & Emergency Rescue Insurance</h3>
                <p>All clients embarking on trekking or mountaineering tours must have comprehensive travel insurance covering emergency helicopter evacuation up to 6,000m.</p>',
                'featured_image' => null,
                'meta_title' => 'Terms & Conditions | Kunlun Treks and Tours',
                'meta_description' => 'Terms and conditions, booking policies, and cancellation terms for Kunlun Treks and Tours.',
                'is_active' => true,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h2>Privacy Policy</h2>
                <p>Kunlun Treks and Tours respects your privacy and is dedicated to protecting your personal information. We only collect the necessary details needed to process tour bookings, visa invitation letters, and national park permits.</p>',
                'featured_image' => null,
                'meta_title' => 'Privacy Policy | Kunlun Treks and Tours',
                'meta_description' => 'Privacy policy explaining how we handle client data and personal information.',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
