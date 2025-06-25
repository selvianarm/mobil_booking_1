<?php

namespace App\Http\Controllers\Admin;

//use App\Mail\BookingApproved;
//use App\Mail\BookingRejected;
//use App\Events\BookingStatusChanged;
//use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\Laporan;

class BookingAdminController extends Controller
{
    // Menampilkan semua booking yang sudah di approved
    public function index()
    {
        $bookings = Booking::where('status', 'approved')->with(['user', 'kendaraan'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    

}
