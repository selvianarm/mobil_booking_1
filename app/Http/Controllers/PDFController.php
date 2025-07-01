<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan; 

use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function export()
    {
        $data = Laporan::all(); // ambil data dari database
        $pdf = PDF::loadView('pdf.tabel', compact('data'));

        return $pdf->download('tabel-data.pdf');
    }
    
}

