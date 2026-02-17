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
        Schema::create('card_frames', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::create('card_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., DARK, LIGHT
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::create('card_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Warrior, Spell
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        Schema::create('card_stars', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Level Star, Rank Star
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['card_frame', 'card_type', 'card_attribute']);

            // Add FKs
            $table->foreignId('card_frame_id')->nullable()->constrained('card_frames')->nullOnDelete();
            $table->foreignId('card_attribute_id')->nullable()->constrained('card_attributes')->nullOnDelete();
            $table->foreignId('card_type_id')->nullable()->constrained('card_types')->nullOnDelete();
            $table->foreignId('card_star_id')->nullable()->constrained('card_stars')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_assets_tables_and_update_categories');
    }
};
