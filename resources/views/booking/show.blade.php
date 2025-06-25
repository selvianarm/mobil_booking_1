@extends('layouts.admin')

@section('title', 'Admin - Detail Booking')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <!-- Judul -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
            <i class="fas fa-clipboard-list mr-2 text-indigo-500"></i> Detail Booking
        </h2>

        <!-- Informasi Umum -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
            <div>
                <p><span class="font-semibold">Nama Karyawan:</span> {{ $booking->user->nama ?? '-' }}</p>
                <p><span class="font-semibold">Nama Peminjam:</span> {{ $booking->nama ?? '-' }}</p>
                <p><span class="font-semibold">No. Telepon:</span> {{ $booking->nomor_telepon }}</p>
                <p><span class="font-semibold">Tanggal:</span> {{ $booking->tanggal }}</p>
                <p><span class="font-semibold">Jam Pergi:</span> {{ $booking->jam_pergi }}</p>
                <p><span class="font-semibold">Jam Pulang:</span> {{ $booking->jam_pulang }}</p>
                <p><span class="font-semibold">Tujuan:</span> {{ $booking->tujuan }}</p>
            </div>
            <div>
                <p><span class="font-semibold">Kendaraan:</span> {{ $booking->kendaraan->jenis ?? '-' }}</p>
                <p><span class="font-semibold">KM Pergi:</span> {{ $booking->km_pergi }}</p>
                <p><span class="font-semibold">KM Pulang:</span> {{ $booking->km_pulang }}</p>
            </div>
        </div>

        <!-- Dokumentasi Foto -->
        <div class="mt-10">
            <h3 class="text-lg font-semibold text-indigo-600 mb-4">Dokumentasi</h3>
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

        @if(auth()->id() === $booking->user_id && $booking->status === 'approved' && $booking->jam_pulang === null)
            <a href="{{ route('booking.return.form', $booking->id) }}"
            class="mt-4 inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Lakukan Pengembalian
            </a>
        @endif

        <a href="{{ route('user.dashboard') }}"
        class="mt-4 inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali ke Dashboard
        </a>

    </div>
</div>
@endsection
