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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('base')->nullable();
            $table->string('main_title')->nullable();
            $table->string('desc')->nullable();
            $table->json('title')->nullable();
            $table->string('cv')->nullable();
            $table->string('image')->nullable();
            $table->string('image_2')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('education')->nullable();
            $table->enum('freelance_status', ['available', 'unavailable'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
