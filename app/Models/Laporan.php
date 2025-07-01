<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $table = 'laporan'; // opsional, jika nama tabel tidak sesuai konvensi

    protected $fillable = [
        'booking_id',
        'user_id',
        'nomor_telepon',
        'tanggal',
        'jam_pergi',
        'jam_pulang',
        'tujuan',
        'kendaraan_id',
        'kendaraan_pengganti_id',
        'km_pergi',
        'km_pulang',
        'bensin_pergi',
        'bensin_pulang',
        'kondisi_body_pergi',
        'kondisi_body_pulang',
        'kondisi_dalam_pergi',
        'kondisi_dalam_pulang',
        'status',
        'catatan_admin',
        'nama',
    ];

    // Relasi ke user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke kendaraan
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function kendaraanPengganti()
{
    return $this->belongsTo(Kendaraan::class, 'kendaraan_pengganti_id');
}
}
