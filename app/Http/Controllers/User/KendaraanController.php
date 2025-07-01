<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();

        return view('user.dashboard', compact('kendaraans'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
       
    }

    public function show(Kendaraan $kendaraan)
{
    $booking = \App\Models\Booking::with('user')
        ->where('kendaraan_id', $kendaraan->id)
        ->whereIn('status', ['approved', 'selesai'])
        ->latest()
        ->first();

    return view('user.kendaraan.detail', compact('kendaraan', 'booking'));
}


    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {

    }
}
