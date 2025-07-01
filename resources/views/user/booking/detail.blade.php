@extends('layouts.app')

@section('title', 'Detail Booking')

@section('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Detail Booking Anda</h2>

    <div class="bg-white p-6 rounded-2xl shadow-md space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
            <div><strong>Nama Karyawan:</strong> {{ $booking->user->nama ?? '-' }}</div>
            <div><strong>Nama Peminjam:</strong> {{ $booking->nama ?? '-' }}</div>
            <div><strong>Jenis Kendaraan:</strong> {{ $kendaraan->jenis }}</div>
            <div><strong>Tujuan:</strong> {{ $booking->tujuan }}</div>
            <div><strong>Tanggal:</strong> {{ $booking->tanggal }}</div>
            <div><strong>Jam Pergi:</strong> {{ $booking->jam_pergi }}</div>
            <div><strong>KM Pergi:</strong> {{ $booking->km_pergi }}</div>
            <div><strong>Status:</strong> 
                <span class="inline-block px-2 py-1 text-sm rounded 
                    {{ $booking->status === 'selesai' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>

        @if($booking->bensin_pergi || $booking->kondisi_body_pergi || $booking->kondisi_dalam_pergi)
        <hr class="my-4 border-gray-300">
        <h3 class="text-xl font-semibold text-gray-800">Dokumentasi Keberangkatan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-2">
            @if($booking->bensin_pergi)
                <div>
                    <p class="font-semibold text-sm mb-1">Bensin Pergi:</p>
                    <img src="{{ asset('storage/' . $booking->bensin_pergi) }}" class="w-full rounded shadow">
                </div>
            @endif
            @if($booking->kondisi_body_pergi)
                <div>
                    <p class="font-semibold text-sm mb-1">Kondisi Body Pergi:</p>
                    <img src="{{ asset('storage/' . $booking->kondisi_body_pergi) }}" class="w-full rounded shadow">
                </div>
            @endif
            @if($booking->kondisi_dalam_pergi)
                <div>
                    <p class="font-semibold text-sm mb-1">Kondisi Dalam Pergi:</p>
                    <img src="{{ asset('storage/' . $booking->kondisi_dalam_pergi) }}" class="w-full rounded shadow">
                </div>
            @endif
        </div>
        @endif

        @if($booking->jam_pulang)
        <hr class="my-4 border-gray-300">
        <h3 class="text-xl font-semibold text-gray-800">Data Pengembalian</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700 mt-2">
            <div><strong>Jam Pulang:</strong> {{ $booking->jam_pulang }}</div>
            <div><strong>KM Pulang:</strong> {{ $booking->km_pulang }}</div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
            @if($booking->bensin_pulang)
                <div>
                    <p class="font-semibold text-sm mb-1">Bensin Pulang:</p>
                    <img src="{{ asset('storage/' . $booking->bensin_pulang) }}" class="w-full rounded shadow">
                </div>
            @endif
            @if($booking->kondisi_body_pulang)
                <div>
                    <p class="font-semibold text-sm mb-1">Kondisi Body Pulang:</p>
                    <img src="{{ asset('storage/' . $booking->kondisi_body_pulang) }}" class="w-full rounded shadow">
                </div>
            @endif
            @if($booking->kondisi_dalam_pulang)
                <div>
                    <p class="font-semibold text-sm mb-1">Kondisi Dalam Pulang:</p>
                    <img src="{{ asset('storage/' . $booking->kondisi_dalam_pulang) }}" class="w-full rounded shadow">
                </div>
            @endif
        </div>
        @else
        <hr class="my-4 border-gray-300">
        @if(auth()->id() === $booking->user_id)
            <a href="{{ route('user.booking.return', $booking->id) }}"
                class="inline-block bg-yellow-500 text-white px-5 py-2 rounded-md hover:bg-yellow-600 transition">
                Kembalikan Kendaraan
            </a>
        @endif
        @endif

        <div class="pt-6">
            <a href="{{ route('user.dashboard') }}"
                class="inline-block bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
