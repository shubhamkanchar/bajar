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
        Schema::create('product_seller_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('seller_id');
            $table->enum('is_contact_accurate', ['yes', 'no']);
            $table->enum('is_location_accurate', ['yes', 'no']);
            $table->unsignedTinyInteger('communication_and_professionalism');
            $table->unsignedTinyInteger('quality_or_service');
            $table->unsignedTinyInteger('recommendation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_seller_reviews');
    }
};
