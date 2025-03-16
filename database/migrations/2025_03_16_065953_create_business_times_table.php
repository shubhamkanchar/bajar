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
        Schema::create('business_times', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('day')->unique();
            $table->string('open_time')->nullable();
            $table->string('close_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_times');
    }
};
