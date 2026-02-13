<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (\App\Models\Product::count() > 0) {
            return;
        }

        $products = [
            [
                'name' => 'Attack on Titan - Scout Regiment Cloak',
                'description' => 'High-quality cosplay cloak featuring the Wings of Freedom.',
                'price' => 49.99,
                'sku' => 'AOT-001',
                'image' => 'https://plus.unsplash.com/premium_photo-1678822365287-e245a499c8f6?q=80&w=1000&auto=format&fit=crop', // Placeholder for cloak-like
                'status' => 1,
            ],
            [
                'name' => 'Naruto - Leaf Village Headband',
                'description' => 'Authentic metal plated headband worn by Naruto Uzumaki.',
                'price' => 19.99,
                'sku' => 'NAR-002',
                'image' => 'https://images.unsplash.com/photo-1578632767115-351597cf2477?q=80&w=1000&auto=format&fit=crop', // Placeholder for anime vibe
                'status' => 1,
            ],
            [
                'name' => 'Demon Slayer - Tanjiro Earrings',
                'description' => 'Hanafuda earrings as seen on Tanjiro Kamado.',
                'price' => 15.50,
                'sku' => 'DS-003',
                'image' => 'https://images.unsplash.com/photo-1618336753974-aae8e04506aa?q=80&w=1000&auto=format&fit=crop', // Placeholder
                'status' => 1,
            ],
            [
                'name' => 'One Piece - Straw Hat',
                'description' => 'The iconic straw hat worn by the future Pirate King, Luffy.',
                'price' => 35.00,
                'sku' => 'OP-004',
                'image' => 'https://images.unsplash.com/photo-1582142407894-ec85f1260a46?q=80&w=1000&auto=format&fit=crop', // Placeholder straw hat
                'status' => 1,
            ],
            [
                'name' => 'Dragon Ball Z - Goku Figure',
                'description' => 'Detailed 10-inch figure of Goku in Super Saiyan form.',
                'price' => 120.00,
                'sku' => 'DBZ-005',
                'image' => 'https://images.unsplash.com/photo-1581833971358-2c8b550f87b3?q=80&w=1000&auto=format&fit=crop', // Anime figure
                'status' => 1,
            ],
             [
                'name' => 'Jujutsu Kaisen - Gojo Blindfold',
                'description' => 'Premium eye mask replica of Satoru Gojo.',
                'price' => 25.00,
                'sku' => 'JJK-006',
                'image' => 'https://images.unsplash.com/photo-1596727147705-54a71280211e?q=80&w=1000&auto=format&fit=crop', // Placeholder
                'status' => 1,
            ],
             [
                'name' => 'My Hero Academia - All Might Hoodie',
                'description' => 'Plus Ultra! Comfortable hoodie inspired by All Might\'s costume.',
                'price' => 55.00,
                'sku' => 'MHA-007',
                'image' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?q=80&w=1000&auto=format&fit=crop', // Hoodie
                'status' => 1,
            ],
             [
                'name' => 'Death Note - Replica Notebook',
                'description' => 'Rule the world with this replica Death Note (feather pen included).',
                'price' => 29.99,
                'sku' => 'DN-008',
                'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1000&auto=format&fit=crop', // Book
                'status' => 1,
            ],
             [
                'name' => 'Poké Ball Replica',
                'description' => 'Electronic die-cast Poké Ball replica with light-up features.',
                'price' => 89.99,
                'sku' => 'PKM-009',
                'image' => 'https://images.unsplash.com/photo-1613771404784-3a5686aa2be3?q=80&w=1000&auto=format&fit=crop', // Red sphere/toy
                'status' => 1,
            ],
             [
                'name' => 'Sailor Moon - Moon Stick',
                'description' => 'Magical wand replica from Sailor Moon.',
                'price' => 65.00,
                'sku' => 'SM-010',
                'image' => 'https://images.unsplash.com/photo-1535157412991-2ef801c1748b?q=80&w=1000&auto=format&fit=crop', // Magic/Sparkle
                'status' => 1,
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
