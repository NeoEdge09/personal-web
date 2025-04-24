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
        Schema::table('comments', function (Blueprint $table) {
            // Rename 'name' column to 'user_name' if it exists
            if (Schema::hasColumn('comments', 'name')) {
                $table->renameColumn('name', 'user_name');
            } else {
                // Add user_name column if it doesn't exist
                $table->string('user_name')->nullable()->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Reverse the column rename/add
            if (Schema::hasColumn('comments', 'user_name')) {
                $table->renameColumn('user_name', 'name');
            } else {
                $table->dropColumn('user_name');
            }
        });
    }
};
