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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'is_approved')) {
                $table->boolean('is_approved')->nullable()->after('user_id');
            }
        });

        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'is_approved')) {
                $table->boolean('is_approved')->nullable()->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'is_approved')) {
                $table->dropColumn('is_approved');
            }
        });

        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'is_approved')) {
                $table->dropColumn('is_approved');
            }
        });
    }
};
