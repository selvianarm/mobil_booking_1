<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Http;
use App\Models\Booking;
use App\Services\WhatsappService;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'kendaraan'])
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = Booking::with('user')->findOrFail($id);

        // Update status booking
        $booking->status = 'approved';
        $booking->save();

        // Tandai kendaraan sebagai tidak tersedia
        $kendaraan = Kendaraan::find($booking->kendaraan_id);
        $kendaraan->status = 'tidak tersedia';
        $kendaraan->save();

        // Kirim WhatsApp ke user
        //$this->sendWhatsappMessage($booking->user->telepon, "Booking Anda telah disetujui oleh admin. Silakan cek detail di aplikasi.");

        return redirect()->back()->with('success', 'Booking disetujui dan WhatsApp telah dikirim.');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        // Kirim pesan penolakan
        //$this->sendWhatsappMessage($booking->no_wa, "Maaf, booking Anda ditolak oleh admin.");

        return redirect()->back()->with('error', 'Booking ditolak.');
    }

    //private function sendWhatsappMessage($phone, $message)
    //{
    //    Http::post('https://api.whatsapp-gateway.test/send', [
    //        'number' => $phone,
    //        'message' => $message,
    //    ]);
    //}

}
