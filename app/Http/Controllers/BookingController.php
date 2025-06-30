<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotification;

class BookingController extends Controller
{
    public function index()
    {
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

        return view('components.userHeader', [
            'kendaraans' => $kendaraans,
            'activeBookings' => $activeBookings,
            'activeBookingCount' => $activeBookingCount,
            'availableCars' => $availableCars,
            'pendingApprovals' => $pendingApprovals,
            'totalTrips' => $totalTrips
        ]);

    }
    
    public function create($id)
    {
        $selectedKendaraan = Kendaraan::findOrFail($id);
        return view('booking.create', compact('selectedKendaraan'));
    }

    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'nomor_telepon' => 'required|string|max:20',
            'tujuan' => 'required|string',
            'km_pergi' => 'required|numeric',
            'jam_pergi' => 'required',
            'bensin_pergi' => 'nullable|image',
            'kondisi_body_pergi' => 'nullable|image',
            'kondisi_dalam_pergi' => 'nullable|image',
        ]);

        // Cek apakah kendaraan sedang dibooking user lain dan belum selesai
        $existingBooking = Booking::where('kendaraan_id', $request->kendaraan_id)
        ->whereIn('status', ['pending', 'approved'])
        ->whereNull('jam_pulang')
        ->first();

        if ($existingBooking) {
        return back()->with('error', 'Kendaraan ini sedang dibooking dan belum tersedia.');
        }


        // Simpan data booking
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->nama = $request->nama;
        $booking->kendaraan_id = $request->kendaraan_id;
        $booking->nomor_telepon = $request->nomor_telepon;
        $booking->tujuan = $request->tujuan;
        $booking->km_pergi = $request->km_pergi;
        $booking->tanggal = $request->tanggal;
        $booking->jam_pergi = $request->jam_pergi;
        //$booking->bensin_pergi = $request->bensin_pergi; // Jika ada input bensin pergi
        //$booking->kondisi_body_pergi = $request->kondisi_body_pergi; // Jika ada input kondisi body pergi
        //$booking->kondisi_dalam_pergi = $request->kondisi_dalam_pergi; // Jika ada input kondisi dalam pergi
        $booking->status = 'pending'; // default

        
        // Upload file jika ada
        if ($request->hasFile('bensin_pergi')) {
            $booking->bensin_pergi = $request->file('bensin_pergi')
                                             ->store('bensin_lergi', 'public');
        }
        
        if ($request->hasFile('kondisi_body_pergi')) {
            $booking->kondisi_body_pergi = $request->file('kondisi_body_pergi')
                                                  ->store('kondisi_body_pergi', 'public');
        }
        
        if ($request->hasFile('kondisi_dalam_pergi')) {
            $booking->kondisi_dalam_pergi = $request->file('kondisi_dalam_pergi')
                                                   ->store('kondisi_dalam_pergi', 'public');
        }

        $booking->save();

        // Kirim email ke admin
        $booking->load('user', 'kendaraan'); // pastikan relasi tersedia

        Mail::to('selvianaramadani305@gmail.com')->send(new \App\Mail\BookingNotification($booking));


        // Redirect dengan flash
        return redirect()->route('user.dashboard')->with('success', 'Booking berhasil dikirim!');
    }

    public function showReturnForm($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.return', compact('booking'));
    }
    public function show($kendaraanId)
    {
        $booking = Booking::with(['user', 'kendaraan'])
            ->where('kendaraan_id', $kendaraanId)
            ->whereIn('status', ['pending', 'approved']) // penting
            ->whereNull('jam_pulang')
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        return view('booking.show', compact('booking'));
    }

    public function storeReturn(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'jam_pulang' => 'required',
            'km_pulang' => 'required|numeric',
            'bensin_pulang' => 'nullable|image',
            'kondisi_body_pulang' => 'nullable|image',
            'kondisi_dalam_pulang' => 'nullable|image',
        ]);

        // Simpan data pengembalian
        $booking->jam_pulang = $request->jam_pulang;
        $booking->km_pulang = $request->km_pulang;

        if ($request->hasFile('bensin_pulang')) {
            $booking->bensin_pulang = $request->file('bensin_pulang')->store('uploads', 'public');
        }
        if ($request->hasFile('kondisi_body_pulang')) {
            $booking->kondisi_body_pulang = $request->file('kondisi_body_pulang')->store('uploads', 'public');
        }
        if ($request->hasFile('kondisi_dalam_pulang')) {
            $booking->kondisi_dalam_pulang = $request->file('kondisi_dalam_pulang')->store('uploads', 'public');
        }

        $booking->status = 'selesai';
        $booking->save();

        // Ubah status kendaraan jadi tersedia
        $booking->kendaraan->update(['status' => 'tersedia']);

        // Buat laporan
        if (!Laporan::where('booking_id', $booking->id)->where('status', 'selesai')->exists()) {
            Laporan::create([
                'booking_id'            => $booking->id,
                'user_id'               => $booking->user_id,
                'kendaraan_id'          => $booking->kendaraan_id,
                'kendaraan_pengganti_id' => $booking->kendaraan_pengganti_id,
                'tanggal'               => $booking->tanggal,
                'tujuan'                => $booking->tujuan,
                'jam_pergi'             => $booking->jam_pergi,
                'km_pergi'              => $booking->km_pergi,
                'jam_pulang'            => $booking->jam_pulang,
                'km_pulang'             => $booking->km_pulang,
                'bensin_pergi'          => $booking->bensin_pergi,
                'bensin_pulang'         => $booking->bensin_pulang,
                'kondisi_body_pergi'    => $booking->kondisi_body_pergi,
                'kondisi_body_pulang'   => $booking->kondisi_body_pulang,
                'kondisi_dalam_pergi'   => $booking->kondisi_dalam_pergi,
                'kondisi_dalam_pulang'  => $booking->kondisi_dalam_pulang,
                'status'                => 'selesai',
                'nomor_telepon'         => $booking->nomor_telepon,
                'nama'                  => $booking->nama,
                'catatan_admin' => $booking->catatan_admin,

            ]);
        }

        return redirect()->route('user.dashboard')->with('success', 'Mobil berhasil dikembalikan dan laporan disimpan.');
    }
}