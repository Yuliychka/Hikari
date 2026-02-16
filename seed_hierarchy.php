<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

// 1. Define Hierarchies
$hierarchy = [
    'Weaponry' => ['Katanas', 'Shuriken', 'Kunai', 'Wooden Swords'],
    'Collectibles' => ['Action Figures', 'Statues', 'Keychains', 'Posters'],
    'Apparel' => ['Hoodies', 'T-Shirts', 'Kimonos', 'Headbands'],
    'Accessory' => ['Jewelry', 'Wallets', 'Bags', 'Phone Cases'],
];

foreach ($hierarchy as $parentName => $children) {
    $parent = Category::updateOrCreate(
        ['name' => $parentName],
        ['slug' => Str::slug($parentName), 'description' => "Premium anime $parentName section"]
    );

    foreach ($children as $childName) {
        Category::updateOrCreate(
            ['name' => $childName],
            [
                'slug' => Str::slug($childName),
                'description' => "Exclusive $childName collectibles",
                'parent_id' => $parent->id
            ]
        );
    }
}

// 2. Assign to Products
$products = Product::all();
$subcategories = Category::whereNotNull('parent_id')->get();

foreach ($products as $product) {
    $sub = $subcategories->random();
    $product->update([
        'category_id' => $sub->parent_id,
        'subcategory_id' => $sub->id
    ]);
}

echo "Successfully seeded categories and updated " . $products->count() . " products.";
