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
        Schema::create('chairman_messages', function (Blueprint $table) {
            $table->id();
              // Chairman
            $table->string('chairman_name')->nullable();
            $table->longText('about_chairman')->nullable();
            $table->string('chairman_image')->nullable();

            // Managing Director
            $table->string('md_name')->nullable();
            $table->longText('md_message')->nullable();
            $table->string('md_image')->nullable();

            $table->boolean('status')->default(true);
 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chairman_messages');
    }
};
