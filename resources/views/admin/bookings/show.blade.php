@extends('layouts.admin')

@section('title', 'Admin - Detail Booking')

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
<div class="min-h-screen py-10 px-4">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <!-- Judul -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
            <i class="fas fa-clipboard-list mr-2 text-orange-500"></i> Detail Booking Kendaraan
        </h2>

        <!-- Informasi Umum -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
            <div>
                <p><span class="font-semibold text-black-600">Nama Karyawan:</span> {{ $booking->user->nama ?? '-' }}</p>
                <p><span class="font-semibold text-black-600">Nama Peminjam:</span> {{ $booking->nama ?? '-' }}</p>
                <p><span class="font-semibold text-black-600">No. Telepon:</span> {{ $booking->nomor_telepon }}</p>
                <p><span class="font-semibold text-black-600">Tanggal:</span> {{ $booking->tanggal }}</p>
                <p><span class="font-semibold text-black-600">Jam Pergi:</span> {{ $booking->jam_pergi }}</p>
                <p><span class="font-semibold text-black-600">Jam Pulang:</span> {{ $booking->jam_pulang }}</p>
                <p><span class="font-semibold text-black-600">Tujuan:</span> {{ $booking->tujuan }}</p>
            </div>
            <div>
                <p><span class="font-semibold text-black-600">Kendaraan:</span> {{ $booking->kendaraan->jenis ?? '-' }}</p>
                <p><span class="font-semibold text-black-600">Kendaraan Pengganti:</span> {{ $booking->kendaraanPengganti->jenis ?? '-' }}</p>
                <p><span class="font-semibold text-black-600">KM Pergi:</span> {{ $booking->km_pergi }}</p>
                <p><span class="font-semibold text-black-600">KM Pulang:</span> {{ $booking->km_pulang }}</p>
                <p><span class="font-semibold text-black-600">Catatan Admin:</span> {{ $booking->catatan_admin}}</p>
            </div>
        </div>

        <!-- Dokumentasi Foto -->
        <div class="mt-10">
            <h3 class="text-lg font-semibold text-orange-600 mb-4">Dokumentasi</h3>
            @php
                $gambarList = [
                    'Bensin Pergi' => $booking->bensin_pergi,
                    'Bensin Pulang' => $booking->bensin_pulang,
                    'Body Pergi' => $booking->kondisi_body_pergi,
                    'Body Pulang' => $booking->kondisi_body_pulang,
                    'Dalam Pergi' => $booking->kondisi_dalam_pergi,
                    'Dalam Pulang' => $booking->kondisi_dalam_pulang
                ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($gambarList as $label => $path)
                    <div class="text-center">
                        <p class="text-sm font-medium text-black-500 mb-1">{{ $label }}</p>
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

        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center px-4 py-2 bg-orange-500 text-white text-sm font-medium rounded-md shadow hover:bg-orange-600 transition duration-200">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>

    </div>
</div>
@endsection
