<?php

namespace App\Http\Controllers\Admin;

use App\Mail\BookingApproved;
use App\Mail\BookingRejected;
use App\Events\BookingStatusChanged;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\Laporan;

class BookingAdminController extends Controller
{
    // Menampilkan semua booking yang masih pending
     public function index()
    {
        $bookings = Booking::where('status', 'pending')->with(['user', 'kendaraan'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = Booking::with('user')->findOrFail($id); // pastikan eager loading user
        $booking->status = 'approved';
        $booking->save();

        // Kirim email ke user
        if ($booking->user && $booking->user->email) {
            Mail::to($booking->user->email)->send(new BookingApproved($booking));
        }

        // Event (jika memang Anda gunakan)
        event(new BookingStatusChanged($booking));

        return redirect()->back()->with('success', 'Booking disetujui dan email telah dikirim.');
    }

    public function reject($id)
    {
        $booking = Booking::with('user')->findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        // Kirim email penolakan
        if ($booking->user && $booking->user->email) {
            Mail::to($booking->user->email)->send(new BookingRejected($booking));
        }

        event(new BookingStatusChanged($booking));

        return redirect()->back()->with('success', 'Booking ditolak dan email telah dikirim.');
    }


}
