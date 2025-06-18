<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Booking;

class DashboardController extends Controller
{
  
    public function index()
{
    $kendaraans = Kendaraan::all();

    $activeBookings = Booking::where('user_id', auth()->id())
        ->where('status', 'approved')
        ->whereNull('jam_pulang')
        ->get()
        ->keyBy('kendaraan_id');

    $activeBookingCount = $activeBookings->count();

    $availableCars = Kendaraan::where('status', 'tersedia')->count();

    $pendingApprovals = Booking::where('user_id', auth()->id())
        ->where('status', 'pending')
        ->count();

    $totalTrips = Booking::where('user_id', auth()->id())
        ->whereNotNull('jam_pulang')
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

}
