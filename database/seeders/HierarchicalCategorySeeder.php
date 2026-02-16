<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HierarchicalCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hierarchy = [
            'Weaponry' => ['Katanas', 'Shuriken', 'Kunai', 'Wooden Swords'],
            'Collectibles' => ['Action Figures', 'Statues', 'Keychains', 'Posters'],
            'Apparel' => ['Hoodies', 'T-Shirts', 'Kimonos', 'Headbands'],
            'Accessories' => ['Jewelry', 'Wallets', 'Bags', 'Phone Cases'],
        ];

        foreach ($hierarchy as $parentName => $children) {
            $parent = \App\Models\Category::updateOrCreate(
                ['name' => $parentName],
                ['slug' => \Illuminate\Support\Str::slug($parentName), 'description' => "Premium anime $parentName section"]
            );

            foreach ($children as $childName) {
                \App\Models\Category::updateOrCreate(
                    ['name' => $childName],
                    [
                        'slug' => \Illuminate\Support\Str::slug($childName),
                        'description' => "Exclusive $childName collectibles",
                        'parent_id' => $parent->id
                    ]
                );
            }
        }

        // Assign to Products
        $products = \App\Models\Product::all();
        $subcategories = \App\Models\Category::whereNotNull('parent_id')->get();

        if ($subcategories->count() > 0) {
            foreach ($products as $product) {
                $sub = $subcategories->random();
                $product->update([
                    'category_id' => $sub->parent_id,
                    'subcategory_id' => $sub->id
                ]);
            }
        }
    }
}
