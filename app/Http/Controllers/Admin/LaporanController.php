<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Laporan; 


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = Booking::with(['user', 'kendaraan'])
                    ->whereIn('status', ['rejected', 'selesai'])
                    ->latest()
                    ->paginate(10); // pakai paginate biar tidak terlalu berat

        return view('admin.laporan.index', compact('laporan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporan = Booking::with(['user', 'kendaraan'])->findOrFail($id);
        return view('admin.laporan.detail', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadPdf($id)
    {
        //$laporan = Laporan::with(['user', 'kendaraan'])->findOrFail($id);
        $laporan = Booking::with(['user', 'kendaraan'])->findOrFail($id);
        $pdf = PDF::loadView('admin.laporan.pdf', compact('laporan'))->setPaper('a4');

        return $pdf->download('laporan-detail-'.$id.'.pdf');
    }
    public function downloadBulan(Request $request)
{
    $bulan = $request->input('bulan'); // Ambil nilai bulan

    // Ambil data berdasarkan bulan
    $laporan = Booking::whereIn('status', ['rejected', 'selesai'])
        ->whereMonth('created_at', $bulan)
        ->orderBy('created_at', 'desc')
        ->get();

    // Generate PDF
    $pdf = \PDF::loadView('admin.laporan.pdf', compact('laporan', 'bulan'));

    return $pdf->download("laporan-bulan-$bulan.pdf");
}


}
