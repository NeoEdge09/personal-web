_table.php
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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();

            // Color settings
            $table->string('primary_color')->nullable()->default('#adff00');
            $table->string('secondary_color')->nullable()->default('#8acc00');
            $table->string('text_color')->nullable()->default('#615978');
            $table->string('heading_color')->nullable()->default('#222');
            $table->string('background_color')->nullable()->default('#aab6c2');

            // Dark mode colors
            $table->string('dark_mode_primary_color')->nullable()->default('#adff00');
            $table->string('dark_mode_background_color')->nullable()->default('#31333c');

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
