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
        Schema::create('verticals', function (Blueprint $table) {
            $table->id();
               $table->string('name')->nullable();

            $table->string('slug')->unique()->nullable();

            $table->string('banner_image')->nullable();

            $table->string('banner_sub_heading')->nullable();

            $table->string('banner_heading')->nullable();

            $table->text('banner_description')->nullable();

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verticals');
    }
};
