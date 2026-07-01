<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('site_settings', function (Blueprint $table){
            $table->id();
            $table->text('company_name')->nullable();
            $table->text('webiste')->nullable();
            $table->text('logo_image')->nullable();
            $table->text('favicon')->nullable();
            $table->text('primary_phone')->nullable();
            $table->text('primary_email')->nullable();
            $table->text('address')->nullable();
            $table->text('copyright_text')->nullable(); 
            $table->text('google_map')->nullable(); 
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
