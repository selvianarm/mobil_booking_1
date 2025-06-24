@extends('layouts.admin')

@section('title', 'Admin - Detail Laporan')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <!-- Judul -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
            <i class="fas fa-clipboard-list mr-2 text-indigo-500"></i> Detail Laporan Kendaraan
        </h2>

        <!-- Informasi Umum -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
            <div>
                <p><span class="font-semibold">Nama Karyawan:</span> {{ $laporan->user->nama ?? '-' }}</p>
                <p><span class="font-semibold">Nama Peminjam:</span> {{ $laporan->nama ?? '-' }}</p>
                <p><span class="font-semibold">No. Telepon:</span> {{ $laporan->nomor_telepon }}</p>
                <p><span class="font-semibold">Tanggal:</span> {{ $laporan->tanggal }}</p>
                <p><span class="font-semibold">Jam Pergi:</span> {{ $laporan->jam_pergi }}</p>
                <p><span class="font-semibold">Jam Pulang:</span> {{ $laporan->jam_pulang }}</p>
                <p><span class="font-semibold">Tujuan:</span> {{ $laporan->tujuan }}</p>
            </div>
            <div>
                <p><span class="font-semibold">Kendaraan:</span> {{ $laporan->kendaraan->jenis ?? '-' }}</p>
                <p><span class="font-semibold">KM Pergi:</span> {{ $laporan->km_pergi }}</p>
                <p><span class="font-semibold">KM Pulang:</span> {{ $laporan->km_pulang }}</p>
            </div>
        </div>

        <!-- Dokumentasi Foto -->
        <div class="mt-10">
            <h3 class="text-lg font-semibold text-indigo-600 mb-4">Dokumentasi</h3>
            @php
                $gambarList = [
                    'Bensin Pergi' => $laporan->bensin_pergi,
                    'Bensin Pulang' => $laporan->bensin_pulang,
                    'Body Pergi' => $laporan->kondisi_body_pergi,
                    'Body Pulang' => $laporan->kondisi_body_pulang,
                    'Dalam Pergi' => $laporan->kondisi_dalam_pergi,
                    'Dalam Pulang' => $laporan->kondisi_dalam_pulang
                ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($gambarList as $label => $path)
                    <div class="text-center">
                        <p class="text-sm font-medium text-gray-600 mb-1">{{ $label }}</p>
                        @if ($path)
                            <a href="{{ Storage::url($path) }}" target="_blank">
                                <img src="{{ Storage::url($path) }}"
                                     class="h-32 w-full object-cover rounded-md shadow-md hover:shadow-lg transition duration-200 ease-in-out" />
                            </a>
                        @else
                            <p class="text-gray-400 italic">Tidak ada foto</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol PDF -->
        <div class="text-center mt-10">
            <a href="{{ route('admin.laporan.download', $laporan->id) }}"
               class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-6 py-2 rounded-full shadow">
                <i class="fas fa-file-pdf mr-2"></i> Download PDF
            </a>
        </div>
    </div>
</div>
@endsection
