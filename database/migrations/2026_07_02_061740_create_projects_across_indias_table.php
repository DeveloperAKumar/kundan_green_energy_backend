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
        Schema::create('projects_across_indias', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("allotment")->nullable();
            $table->text('detail')->nullable();
            $table->string('type')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_across_indias');
    }
};
