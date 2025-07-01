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
         Schema::table('kendaraan', function (Blueprint $table) {
            $table->enum('status', ['tersedia', 'tidak tersedia', 'rusak'])->default('tersedia')->change();
        });
    }


    public function down(): void
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
