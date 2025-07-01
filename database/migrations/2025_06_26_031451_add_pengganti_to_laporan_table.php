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
        Schema::table('laporan', function (Blueprint $table) {
            $table->unsignedBigInteger('kendaraan_pengganti_id')->nullable()->after('kendaraan_id');
            $table->enum('catatan_admin', ['rusak', 'lainnya'])->nullable()->after('status');
            $table->foreign('kendaraan_pengganti_id')->references('id')->on('kendaraan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropForeign(['kendaraan_pengganti_id']);
            $table->dropColumn(['kendaraan_pengganti_id', 'catatan_admin']);
        });
    }
};
