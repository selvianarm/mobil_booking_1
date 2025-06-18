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
        // Tambahkan kolom hanya jika belum ada
        if (!Schema::hasColumn('kendaraans', 'status')) {
            Schema::table('kendaraans', function (Blueprint $table) {
                $table->string('status')->default('Tersedia');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus kolom hanya jika ada
        if (Schema::hasColumn('kendaraans', 'status')) {
            Schema::table('kendaraans', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
