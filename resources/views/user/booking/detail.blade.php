@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-4">Detail Booking Anda</h2>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Jenis Kendaraan:</strong> {{ $kendaraan->jenis }}</p>
        <p><strong>Tujuan:</strong> {{ $booking->tujuan }}</p>
        <p><strong>Tanggal:</strong> {{ $booking->tanggal }}</p>
        <p><strong>Jam Pergi:</strong> {{ $booking->jam_pergi }}</p>
        <p><strong>KM Pergi:</strong> {{ $booking->km_pergi }}</p>
        <p><strong>Status:</strong> {{ $booking->status }}</p>

        @if($booking->bensin_pergi)
            <p class="mt-4 font-semibold">Bensin Pergi:</p>
            <img src="{{ asset('storage/' . $booking->bensin_pergi) }}" class="w-48">
        @endif

        @if($booking->kondisi_body_pergi)
            <p class="mt-4 font-semibold">Kondisi Body Pergi:</p>
            <img src="{{ asset('storage/' . $booking->kondisi_body_pergi) }}" class="w-48">
        @endif

        @if($booking->kondisi_dalam_pergi)
            <p class="mt-4 font-semibold">Kondisi Dalam Pergi:</p>
            <img src="{{ asset('storage/' . $booking->kondisi_dalam_pergi) }}" class="w-48">
        @endif

        @if($booking->jam_pulang)
            <hr class="my-4">
            <h3 class="text-lg font-bold mb-2">Data Pengembalian</h3>
            <p><strong>Jam Pulang:</strong> {{ $booking->jam_pulang }}</p>
            <p><strong>KM Pulang:</strong> {{ $booking->km_pulang }}</p>

            @if($booking->bensin_pulang)
                <p class="mt-4 font-semibold">Bensin Pulang:</p>
                <img src="{{ asset('storage/' . $booking->bensin_pulang) }}" class="w-48">
            @endif

            @if($booking->kondisi_body_pulang)
                <p class="mt-4 font-semibold">Kondisi Body Pulang:</p>
                <img src="{{ asset('storage/' . $booking->kondisi_body_pulang) }}" class="w-48">
            @endif

            @if($booking->kondisi_dalam_pulang)
                <p class="mt-4 font-semibold">Kondisi Dalam Pulang:</p>
                <img src="{{ asset('storage/' . $booking->kondisi_dalam_pulang) }}" class="w-48">
            @endif
        @else
            <hr class="my-4">
            @if(auth()->id() === $booking->user_id)
                <a href="{{ route('user.booking.return', $booking->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Kembalikan Kendaraan
                </a>
            @endif
        @endif

        {{-- Tombol kembali yang dapat dilihat oleh semua --}}
        <div class="mt-6">
            <a href="{{ route('user.dashboard') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-800">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
