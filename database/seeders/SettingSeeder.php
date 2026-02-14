<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::updateOrCreate(['key' => 'facebook_url'], ['value' => 'https://facebook.com/hikari']);
        \App\Models\Setting::updateOrCreate(['key' => 'instagram_url'], ['value' => 'https://instagram.com/hikari']);
        \App\Models\Setting::updateOrCreate(['key' => 'discord_url'], ['value' => 'https://discord.gg/hikari']);
    }
}
