<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How fit do I need to be for the K2 Base Camp Trek?',
                'answer' => '<p>The K2 Base Camp trek is a strenuous high-altitude trek that requires very good cardiovascular fitness and physical stamina. You should be comfortable walking 6 to 8 hours daily over rugged glacial terrain and loose moraine. Regular hiking, stair climbing with a weighted backpack, and cardio workouts for 3 to 6 months prior are strongly recommended.</p>',
                'category' => 'Trekking & Fitness',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'How do I obtain a Pakistan tourist / trekking visa?',
                'answer' => '<p>Pakistan now offers a fast and straightforward online e-Visa system (visa.nadra.gov.pk). Kunlun Treks and Tours provides an official letter of invitation (LOI), licensed tour operator registration certificate, and confirmed tour itinerary required for your e-Visa application.</p>',
                'category' => 'Visa & Travel Formalities',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'What happens in case of a medical emergency at high altitude?',
                'answer' => '<p>Safety is our number one priority. Our guides carry satellite phones, pulse oximeters to check blood oxygen levels daily, comprehensive first aid trauma kits, and emergency oxygen bottles. In serious cases, we maintain immediate 24/7 coordination with Askari Aviation military rescue helicopters for swift evacuation.</p>',
                'category' => 'Safety & Medical',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'What kind of meals and drinking water are provided on treks?',
                'answer' => '<p>Our dedicated professional mountain kitchen crew prepares fresh, hot, and nutritionally balanced breakfasts, lunches, and multi-course dinners using local ingredients. Safe boiled and filtered drinking water is provided continuously at camps and before each day’s walk.</p>',
                'category' => 'Food & Logistics',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }
    }
}
