<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';

    protected $fillable = ['jenis', 'foto', 'status'];

    public function bookings() {
        return $this->hasMany(Booking::class, 'kendaraan_id');
    }

    public function laporan() {
        return $this->hasMany(Laporan::class, 'kendaraan_id');
    }

    public function activeBooking()
    {
        return $this->hasOne(Booking::class)
                    ->where('status', 'approved');
    }

    public function isBooked()
    {
        return $this->activeBooking()->exists();
    }


}

