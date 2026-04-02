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
        Schema::create('plant_species', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('perenual_id')->unique();
            $table->string('common_name');
            $table->json('scientific_name')->nullable();
            $table->json('other_name')->nullable();
            $table->string('family')->nullable();
            $table->string('genus')->nullable();
            $table->string('cycle')->nullable();
            $table->string('watering')->nullable();
            $table->string('sunlight')->nullable();
            $table->string('image_url')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_species');
    }
};
