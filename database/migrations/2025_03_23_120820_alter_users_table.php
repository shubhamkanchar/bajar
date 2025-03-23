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
        Schema::table('users',function(Blueprint $table){
            if(!Schema::hasColumn('users','is_admin')){
                $table->tinyInteger('is_admin')->nullable()->default(0);
            }

            if(!Schema::hasColumn('users','is_reviewer')){
                $table->tinyInteger('is_reviewer')->nullable()->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users',function(Blueprint $table){
            if(Schema::hasColumn('users','is_admin')){
                $table->dropColumn('is_admin');
            }

            if(Schema::hasColumn('users','is_reviewer')){
                $table->dropColumn('is_reviewer');
            }
        });
    }
};
