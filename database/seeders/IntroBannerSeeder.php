<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class IntroBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Dragon Ball Panel',
                'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQg0jUmTFxk4d0CGtZfkp9Z5WVCV3vk5JOGZg&s',
                'type' => 'intro',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'JJK Panel 1',
                'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_xIs0yY_lGk8fD5kG_U0p7O8f9v1M7f_wZw&s',
                'type' => 'intro',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'AOT Panel 1',
                'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCnC9X9d9sL_hE9wB3v1u_d0f7s9wM_x1uCw&s',
                'type' => 'intro',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Naruto Panel 1',
                'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_uI7v9E9X9d9sL_hE9wB3v1u_d0f7s9wM_x1uCw&s',
                'type' => 'intro',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'One Piece Panel 1',
                'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_xIs0yY_lGk8fD5kG_U0p7O8f9v1M7f_wZw&s',
                'type' => 'intro',
                'is_active' => true,
                'order' => 5,
            ],
             [
                'title' => 'Bleach Panel 1',
                'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_xIs0yY_lGk8fD5kG_U0p7O8f9v1M7f_wZw&s',
                'type' => 'intro',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['title' => $banner['title'], 'type' => 'intro'],
                $banner
            );
        }
    }
}
