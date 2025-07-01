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
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('kendaraan_pengganti_id')->nullable()->after('kendaraan_id');
            DB::statement("ALTER TABLE bookings MODIFY catatan_admin ENUM('rusak', 'lainnya') NULL");
            $table->foreign('kendaraan_pengganti_id')->references('id')->on('kendaraan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            DB::statement("ALTER TABLE bookings MODIFY catatan_admin TEXT NULL");
        });
    }
};
