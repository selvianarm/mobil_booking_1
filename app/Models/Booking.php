<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kendaraan;


class Booking extends Model
{
    protected $table = 'bookings'; // Sesuai nama tabel di database

    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'nomor_telepon',
        'tanggal',
        'tujuan',
        'km_pergi',
        'km_pulang',
        'bensin_pergi',
        'bensin_pulang',
        'kondisi_body_pergi',
        'kondisi_body_pulang',
        'kondisi_dalam_pergi',
        'kondisi_dalam_pulang',
        'jam_pergi',
        'jam_pulang'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function kendaraan()
{
    return $this->belongsTo(Kendaraan::class);
}

public function kendaraanPengganti()
{
    return $this->belongsTo(Kendaraan::class, 'kendaraan_pengganti_id');
}
    
}
