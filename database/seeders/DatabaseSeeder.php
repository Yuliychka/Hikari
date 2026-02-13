<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@anime.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // or Hash::make('password')
                'role' => 'admin',
            ]
        );

        // Create Regular User
        \App\Models\User::firstOrCreate(
            ['email' => 'user@anime.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]
        );

        $this->call([
            ProductSeeder::class,
            BannerSeeder::class,
        ]);
    }
}
