<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\Sopir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
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
            $booking->bensin_pergi = $request->file('bensin_pergi')->store('kondisi');
        }
        if ($request->hasFile('kondisi_body_pergi')) {
            $booking->kondisi_body_pergi = $request->file('kondisi_body_pergi')->store('kondisi');
        }
        if ($request->hasFile('kondisi_dalam_pergi')) {
            $booking->kondisi_dalam_pergi = $request->file('kondisi_dalam_pergi')->store('kondisi');
        }

        $booking->save();

        // Redirect dengan flash
        return redirect()->route('user.dashboard')->with('success', 'Booking berhasil dikirim!');
    }

    public function showReturnForm($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.return', compact('bookings'));
    }

    public function storeReturn(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->km_pulang = $request->km_pulang;
        $booking->jam_pulang = $request->jam_pulang;

        if ($request->hasFile('bensin_pulang')) {
            $booking->bensin_pulang = $request->file('bensin_pulang')->store('kondisi');
        }

        if ($request->hasFile('kondisi_body_pulang')) {
            $booking->kondisi_body_pulang = $request->file('kondisi_body_pulang')->store('kondisi');
        }

        if ($request->hasFile('kondisi_dalam_pulang')) {
            $booking->kondisi_dalam_pulang = $request->file('kondisi_dalam_pulang')->store('kondisi');
        }

        $booking->save();

        return redirect()->route('booking.return', $id)->with('success', 'Pengembalian berhasil disimpan.');
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'tanggal' => 'required|date',
    //         'kendaraan_id' => 'required|exists:kendaraans,id',
    //         'sopir_id' => 'required|exists:sopirs,id',
    //         'nomor_telepon' => 'required|string|max:25',
    //         'tujuan' => 'required|string',
    //         'km_pergi' => 'required|integer',
    //         'km_pulang' => 'nullable|integer',
    //         'jam_pergi' => 'required',
    //         'jam_pulang' => 'nullable',
    //         'bensin_pergi' => 'nullable|image',
    //         'bensin_pulang' => 'nullable|image',
    //         'kondisi_body_pergi' => 'nullable|image',
    //         'kondisi_body_pulang' => 'nullable|image',
    //         'kondisi_dalam_pergi' => 'nullable|image',
    //         'kondisi_dalam_pulang' => 'nullable|image',
    //     ]);


    //     $bookings = new \App\Models\Booking();
    //     $bookings->fill($validated);
    //     $bookings->user_id = auth()->id(); 

    //     // Upload file
    //     $uploadField = fn($name) => $request->hasFile($name) 
    //         ? $request->file($name)->store('uploads', 'public') 
    //         : null;

    //     $bookings->bensin_pergi = $uploadField('bensin_pergi');
    //     $bookings->bensin_pulang = $uploadField('bensin_pulang');
    //     $bookings->kondisi_body_pergi = $uploadField('kondisi_body_pergi');
    //     $bookings->kondisi_body_pulang = $uploadField('kondisi_body_pulang');
    //     $bookings->kondisi_dalam_pergi = $uploadField('kondisi_dalam_pergi');
    //     $bookings->kondisi_dalam_pulang = $uploadField('kondisi_dalam_pulang');

    //     $bookings->save();

    //     return redirect()->route('dashboard')->with('success', 'Booking berhasil disimpan!');
    // }


}