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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('type')->nullable();
            $table->string('offering')->nullable();
            $table->string('email_otp')->nullable();
            $table->string('phone_otp')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('bg_image')->nullable();
            $table->string('gst')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('is_reviewer')->nullable()->default(0);
            $table->tinyInteger('onboard_completed')->default(0)->nullable();
            $table->enum('role',['individual','business','admin','superadmin'])->default('individual');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
