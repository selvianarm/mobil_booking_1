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
            $table->time('jam_pulang')->nullable();
            $table->integer('km_pulang')->nullable();
            $table->string('bensin_pergi')->nullable();
            $table->string('bensin_pulang')->nullable();
            $table->string('kondisi_body_pergi')->nullable();
            $table->string('kondisi_body_pulang')->nullable();
            $table->string('kondisi_dalam_pergi')->nullable();
            $table->string('kondisi_dalam_pulang')->nullable();
        });

        // Ubah enum status
        DB::statement("ALTER TABLE laporan MODIFY status ENUM('rejected', 'selesai')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn([
                'jam_pulang',
                'km_pulang',
                'bensin_pergi',
                'bensin_pulang',
                'kondisi_body_pergi',
                'kondisi_body_pulang',
                'kondisi_dalam_pergi',
                'kondisi_dalam_pulang',
            ]);
        });

        // Kembalikan enum status ke semula
        DB::statement("ALTER TABLE laporan MODIFY status ENUM('approved', 'rejected')");
    }
};
