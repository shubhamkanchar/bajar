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
        Schema::table('services', function (Blueprint $table) {
            if(Schema::hasColumn('services','service_tag_group_id')){
                $table->dropColumn('service_tag_group_id');
            }
            if(!Schema::hasColumn('services','service_tag')){
                $table->string('service_tag')->after('category_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if(!Schema::hasColumn('services','service_tag_group_id')){
                $table->string('service_tag_group_id')->after('category_id')->nullable();
            }
            if(!Schema::hasColumn('services','service_tag')){
                $table->dropColumn('service_tag');
            }
        });
    }
};
