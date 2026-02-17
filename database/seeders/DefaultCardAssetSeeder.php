<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CardFrame;
use App\Models\CardAttribute;
use App\Models\CardStar;
use App\Models\Category;

class DefaultCardAssetSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Frame
        $frame = CardFrame::updateOrCreate(
            ['name' => 'Default Frame'],
            ['image_path' => 'card-assets/defaults/default_frame.jpg']
        );

        // 2. Create Default Attribute (DARK)
        $attribute = CardAttribute::updateOrCreate(
            ['name' => 'DARK'],
            ['image_path' => 'card-assets/defaults/default_attribute.jpg']
        );

        // 3. Create Default Star
        $star = CardStar::updateOrCreate(
            ['name' => 'Default Star'],
            ['image_path' => 'card-assets/defaults/default_star.png']
        );

        // 4. Update only categories with missing assets (Safe Mode)
        Category::whereNull('card_frame_id')->update(['card_frame_id' => $frame->id]);
        Category::whereNull('card_attribute_id')->update(['card_attribute_id' => $attribute->id]);
        Category::whereNull('card_star_id')->update(['card_star_id' => $star->id]);
        Category::whereNull('card_level')->update(['card_level' => 4]);
    }
}
