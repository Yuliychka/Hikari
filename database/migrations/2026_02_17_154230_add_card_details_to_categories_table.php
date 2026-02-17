<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('card_frame')->nullable()->after('image_path'); // e.g., 'effect', 'spell', 'trap', or custom image path
            $table->string('card_type')->nullable()->after('card_frame'); // e.g., "Warrior / Effect"
            $table->string('card_attribute')->nullable()->after('card_type'); // e.g., "DARK"
            $table->integer('card_level')->default(4)->after('card_attribute'); // Number of stars
            $table->string('card_atk')->nullable()->after('card_level');
            $table->string('card_def')->nullable()->after('card_atk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
};
