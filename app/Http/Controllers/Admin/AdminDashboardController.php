<?php

namespace App\Http\Controllers\Admin;

use App\Mail\BookingApproved;
use App\Mail\BookingRejected;
use App\Events\BookingStatusChanged;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Http;
use App\Models\Booking;

class AdminDashboardController extends Controller
{
    // Menampilkan semua booking yang maish pending
    public function index()
{
    // Ambil semua kendaraan
    $kendaraans = Kendaraan::all();

    // Ambil 10 booking yang statusnya pending, untuk ditampilkan
    $bookings = Booking::with(['user', 'kendaraan'])
        ->where('status', 'pending')
        ->latest()
        ->take(10)
        ->get();

    // Ambil semua booking aktif (disetujui dan belum pulang)
    $activeBookings = Booking::where('status', 'approved')
        ->whereNull('jam_pulang')
        ->get();

    // Hitung jumlah booking aktif
    $activeBookingCount = $activeBookings->count();

    // Ambil ID kendaraan yang sedang aktif dipakai
    $activeKendaraanIds = $activeBookings->pluck('kendaraan_id')->unique();

    // Hitung jumlah kendaraan yang belum dipakai (tersedia)
    $availableCars = Kendaraan::whereNotIn('id', $activeKendaraanIds)->count();

    // Tambahkan: Hitung total booking yang ditolak
    $rejectedCount = Booking::where('status', 'rejected')->count();

    return view('admin.dashboard', [
        'kendaraans' => $kendaraans,
        'bookings' => $bookings,
        'activeBookingCount' => $activeBookingCount,
        'availableCars' => $availableCars,
        'rejectedCount' => $rejectedCount, // <== kirim ke view
    ]);
}

            

    public function approve($id)
    {
        $booking = Booking::with('user')->findOrFail($id);

        // Update status booking
        $booking->status = 'approved';
        $booking->save();

        // Kirim email ke user
        if ($booking->user && $booking->user->email) {
            Mail::to($booking->user->email)->send(new BookingApproved($booking));
        }

        // Event (jika memang Anda gunakan)
        event(new BookingStatusChanged($booking));

        // Tandai kendaraan sebagai tidak tersedia
        $kendaraan = Kendaraan::find($booking->kendaraan_id);
        $kendaraan->status = 'tidak tersedia';
        $kendaraan->save();

        
        return redirect()->back()->with('success', 'Booking disetujui dan email telah dikirim.');
    }

public function reject($id)
    {
        $booking = Booking::with('user')->findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        // Buat laporan
        if (!Laporan::where('booking_id', $booking->id)->exists()) {
            Laporan::create([
                'booking_id'     => $booking->id,
                'user_id'        => $booking->user_id,
                'kendaraan_id'   => $booking->kendaraan_id,
                'tanggal'        => $booking->tanggal,
                'tujuan'         => $booking->tujuan,
                'jam_pergi'      => $booking->jam_pergi,
                'km_pergi'       => $booking->km_pergi,
                'status'         => 'rejected',
                'nomor_telepon'         => $booking->nomor_telepon,
                'nama'                  => $booking->nama,
            ]);
        }

        // Kirim email
        if ($booking->user && $booking->user->email) {
            Mail::to($booking->user->email)->send(new BookingRejected($booking));
        }

        event(new BookingStatusChanged($booking));

        return redirect()->back()->with('success', 'Booking ditolak dan email telah dikirim.');
    }

}
