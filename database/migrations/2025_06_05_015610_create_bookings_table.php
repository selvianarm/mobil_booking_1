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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('nama');

            // ⬅️ Tambahkan ini sebelum foreign key-nya
            $table->unsignedBigInteger('user_id')->nullable(); 

            $table->unsignedBigInteger('kendaraan_id')->nullable();

            $table->string('nomor_telepon', 25)->nullable();
            $table->date('tanggal');
            $table->text('tujuan');

            $table->integer('km_pergi')->nullable();
            $table->integer('km_pulang')->nullable();

            $table->string('bensin_pergi')->nullable();
            $table->string('bensin_pulang')->nullable();

            $table->string('kondisi_body_pergi')->nullable();
            $table->string('kondisi_body_pulang')->nullable();

            $table->string('kondisi_dalam_pergi')->nullable();
            $table->string('kondisi_dalam_pulang')->nullable();

            $table->time('jam_pergi')->nullable();
            $table->time('jam_pulang')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('sopir_id')->references('id')->on('sopirs')->nullOnDelete();
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->nullOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
