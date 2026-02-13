<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hero Banner
        Banner::create([
            'title' => 'Konnichiwa!',
            'image_path' => 'images/Q.gif', // Assuming this path exists from welcome.blade.php
            'type' => 'hero',
            'link' => route('products.index'),
            'is_active' => true,
            'order' => 1,
        ]);

        // Promo Banner
        Banner::create([
            'title' => 'Limited Time Flash Sale!',
            'image_path' => 'https://images.unsplash.com/photo-1541562232579-512a21360020?q=80&w=1920&auto=format&fit=crop',
            'type' => 'promo',
            'link' => route('products.index'),
            'is_active' => true,
            'order' => 1,
        ]);

        // Category Banners
        $categories = [
            [
                'title' => 'Figures',
                'image' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?q=80&w=1000&auto=format&fit=crop',
            ],
            [
                'title' => 'Apparel',
                'image' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?q=80&w=1000&auto=format&fit=crop',
            ],
            [
                'title' => 'Accessories',
                'image' => 'https://images.unsplash.com/photo-1613376023733-0a73315d9b06?q=80&w=1000&auto=format&fit=crop',
            ]
        ];

        foreach ($categories as $index => $cat) {
            Banner::create([
                'title' => $cat['title'],
                'image_path' => $cat['image'],
                'type' => 'category',
                'link' => '#',
                'is_active' => true,
                'order' => $index + 1,
            ]);
        }
    }
}
