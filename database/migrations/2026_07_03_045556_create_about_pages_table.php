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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
              // Who We Are
            $table->string('who_we_are_small_heading')->nullable();
            $table->string('who_we_are_heading')->nullable();
            $table->longText('who_we_are_description')->nullable();
            $table->string('who_we_are_image')->nullable();

            // Vision
            $table->string('vision_small_heading')->nullable();
            $table->string('vision_heading')->nullable();
            $table->longText('vision_description')->nullable();
            $table->string('vision_image')->nullable();

            // Mission
            $table->string('mission_small_heading')->nullable();
            $table->string('mission_heading')->nullable();
            $table->longText('mission_description')->nullable();
            $table->string('mission_image')->nullable();

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
