<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class AboutPageAssetSeeder extends Seeder
{
    public function run(): void
    {
        // Register About Page Brand Images
        Setting::updateOrCreate(
            ['key' => 'about_brand_image_1'],
            ['value' => 'site-assets/about/brand_wave.png']
        );

        Setting::updateOrCreate(
            ['key' => 'about_brand_image_2'],
            ['value' => 'site-assets/about/brand_torii.png']
        );
    }
}
