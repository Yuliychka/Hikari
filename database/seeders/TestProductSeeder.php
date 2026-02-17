<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class TestProductSeeder extends Seeder
{
    public function run()
    {
        // Get some categories
        $categories = Category::where('parent_id', null)->get();
        
        if ($categories->isEmpty()) {
            $this->command->error('No categories found. Please create categories first.');
            return;
        }

        $products = [
            [
                'name' => 'Naruto Uzumaki Figure',
                'description' => 'High-quality collectible figure of Naruto in Sage Mode',
                'price' => 89.99,
                'stock_quantity' => 15,
                'sku' => 'NAR-001',
                'image' => 'https://images.unsplash.com/photo-1601814933824-fd0b574dd592?w=500'
            ],
            [
                'name' => 'Attack on Titan Poster Set',
                'description' => 'Set of 3 premium posters featuring the Survey Corps',
                'price' => 24.99,
                'stock_quantity' => 50,
                'sku' => 'AOT-002',
                'image' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=500'
            ],
            [
                'name' => 'One Piece Luffy Hoodie',
                'description' => 'Comfortable hoodie with Straw Hat Pirates logo',
                'price' => 45.00,
                'stock_quantity' => 30,
                'sku' => 'OP-003',
                'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=500'
            ],
            [
                'name' => 'Demon Slayer Katana Replica',
                'description' => 'Authentic replica of Tanjiro\'s Nichirin Blade',
                'price' => 129.99,
                'stock_quantity' => 8,
                'sku' => 'DS-004',
                'image' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=500'
            ],
            [
                'name' => 'My Hero Academia Manga Vol 1-10',
                'description' => 'Complete box set of volumes 1 through 10',
                'price' => 99.99,
                'stock_quantity' => 20,
                'sku' => 'MHA-005',
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500'
            ],
            [
                'name' => 'Dragon Ball Z Goku Statue',
                'description' => 'Limited edition Super Saiyan Goku statue',
                'price' => 199.99,
                'stock_quantity' => 5,
                'sku' => 'DBZ-006',
                'image' => 'https://images.unsplash.com/photo-1613376023733-0a73315d9b06?w=500'
            ],
            [
                'name' => 'Tokyo Ghoul Kaneki Mask',
                'description' => 'High-quality cosplay mask with adjustable straps',
                'price' => 34.99,
                'stock_quantity' => 25,
                'sku' => 'TG-007',
                'image' => 'https://images.unsplash.com/photo-1578632292335-df3abbb0d586?w=500'
            ],
            [
                'name' => 'Fullmetal Alchemist Pocket Watch',
                'description' => 'Replica of Edward Elric\'s State Alchemist watch',
                'price' => 39.99,
                'stock_quantity' => 40,
                'sku' => 'FMA-008',
                'image' => 'https://images.unsplash.com/photo-1509048191080-d2984bad6ae5?w=500'
            ],
            [
                'name' => 'Sword Art Online Kirito Coat',
                'description' => 'Black coat inspired by Kirito\'s signature outfit',
                'price' => 79.99,
                'stock_quantity' => 12,
                'sku' => 'SAO-009',
                'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=500'
            ],
            [
                'name' => 'Jujutsu Kaisen Sukuna Funko Pop',
                'description' => 'Collectible vinyl figure of Ryomen Sukuna',
                'price' => 14.99,
                'stock_quantity' => 60,
                'sku' => 'JJK-010',
                'image' => 'https://images.unsplash.com/photo-1608889476561-6242cfdbf622?w=500'
            ],
        ];

        foreach ($products as $productData) {
            // Randomly assign a category
            $category = $categories->random();
            
            // Get subcategories if available
            $subcategory = null;
            if ($category->children && $category->children->count() > 0) {
                $subcategory = $category->children->random();
            }

            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock_quantity' => $productData['stock_quantity'],
                'sku' => $productData['sku'],
                'image' => $productData['image'],
                'category_id' => $category->id,
                'subcategory_id' => $subcategory ? $subcategory->id : null,
                'status' => 1,
            ]);
        }

        $this->command->info('10 test products created successfully!');
    }
}
