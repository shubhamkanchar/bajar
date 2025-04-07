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
        Schema::table('business_times', function (Blueprint $table) {
            // Drop the unique index on 'day'
            $table->dropUnique(['day']);

            // Add a composite unique index on 'user_id' and 'day'
            $table->unique(['user_id', 'day']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_times', function (Blueprint $table) {
            // Rollback: drop composite unique and restore old unique on 'day'
            $table->dropUnique(['user_id', 'day']);
            $table->unique('day');
        });
    }
};
