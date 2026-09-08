<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingsSeeder::class,
            SocialLinkSeeder::class,
            CategorySeeder::class,
            SliderSeeder::class,
            HomepageSectionSeeder::class,
            PackageSeeder::class,
            TestimonialSeeder::class,
            TeamMemberSeeder::class,
            FaqSeeder::class,
            PageSeeder::class,
            BlogPostSeeder::class,
        ]);
    }
}
