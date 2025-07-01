<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Booking;

class DashboardController extends Controller
{
  
//     public function index()
// {
//     $kendaraans = Kendaraan::all();

//     $activeBookings = Booking::where('user_id', auth()->id())
//         ->where('status', 'approved')
//         ->whereNull('jam_pulang')
//         ->get()
//         ->keyBy('kendaraan_id');

//     $activeBookingCount = $activeBookings->count();

//     $availableCars = Kendaraan::where('status', 'tersedia')->count();

//     $pendingApprovals = Booking::where('user_id', auth()->id())
//         ->where('status', 'pending')
//         ->count();

//     $totalTrips = Booking::where('user_id', auth()->id())
//         ->whereNotNull('jam_pulang')
//         ->count();

//     return view('user.dashboard', [
//         'kendaraans' => $kendaraans,
//         'activeBookings' => $activeBookings,
//         'activeBookingCount' => $activeBookingCount,
//         'availableCars' => $availableCars,
//         'pendingApprovals' => $pendingApprovals,
//         'totalTrips' => $totalTrips
//     ]);
// }


public function index()
{
    // Ambil semua kendaraan
    $kendaraans = Kendaraan::all();

    // Ambil semua booking yang masih aktif (belum pulang), tidak dibatasi oleh user_id
    $activeBookings = Booking::with('user', 'kendaraan')
        ->whereIn('status', ['pending', 'approved'])
        ->whereNull('jam_pulang')
        ->get()
        ->keyBy('kendaraan_id');


    // Hitung berapa kendaraan yang sedang user ini pakai (booking aktif milik user)
    $activeBookingCount = $activeBookings->count();

    // Kendaraan yang tersedia (belum dibooking)
    $availableCars = Kendaraan::whereNotIn('id', $activeBookings->keys())->count();
    // Booking milik user yang masih pending
    $pendingApprovals = Booking::where('status', 'pending')
        ->count();

    // Booking milik user yang sudah selesai (jam_pulang sudah terisi)
    $totalTrips = Booking::whereNotNull('jam_pulang')
        ->count();

    return view('user.dashboard', [
        'kendaraans' => $kendaraans,
        'activeBookings' => $activeBookings,
        'activeBookingCount' => $activeBookingCount,
        'availableCars' => $availableCars,
        'pendingApprovals' => $pendingApprovals,
        'totalTrips' => $totalTrips
    ]);
}



public function return(Request $request, Booking $booking)
{
    $this->authorize('update', $booking); // Optional: pastikan yang return adalah pemilik booking

    $request->validate([
        'jam_pulang' => 'required',
        'kondisi_body_pulang' => 'required',
        'foto_body_pulang' => 'nullable|image',
        // tambahkan validasi lainnya
    ]);

    $booking->jam_pulang = $request->jam_pulang;
    $booking->kondisi_body_pulang = $request->kondisi_body_pulang;

    if ($request->hasFile('foto_body_pulang')) {
        $booking->foto_body_pulang = $request->file('foto_body_pulang')->store('uploads', 'public');
    }

    // tambahkan penyimpanan file lainnya

    $booking->status = 'dikembalikan';
    $booking->save();

    // Ubah status kendaraan kembali menjadi tersedia
    $booking->kendaraan->status = 'tersedia';
    $booking->kendaraan->save();

    return redirect()->route('user.dashboard')->with('success', 'Mobil berhasil dikembalikan.');
}

// public function show(Kendaraan $kendaraan)
// {
//     $booking = Booking::where('kendaraan_id', $kendaraan->id)
//                       ->where('user_id', auth()->id())
//                       ->where('status', 'approved')
//                       ->firstOrFail();

//     return view('user.booking.detail', compact('kendaraan', 'booking'));
// }


    public function show(Kendaraan $kendaraan)
{
    $booking = Booking::with(['user'])
        ->where(function ($query) use ($kendaraan) {
            $query->where('kendaraan_id', $kendaraan->id)
                  ->orWhere('kendaraan_pengganti_id', $kendaraan->id);
        })
        ->whereIn('status', ['approved', 'pending'])
        ->latest()
        ->first();

    if (!$booking) {
        return redirect()->route('user.dashboard')->with('error', 'Booking aktif tidak ditemukan.');
    }

    return view('user.booking.detail', compact('kendaraan','booking'));
}

}



