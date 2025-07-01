@extends('layouts.app')

@section('title', 'Form Booking Kendaraan')

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
<div class="max-w-3xl mx-auto px-6 py-12 mt-20" >
    <div class="bg-white p-8 rounded-2xl shadow-md">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Form Booking</h1>
            <p class="text-gray-500">Tolong isi dan lengkapi data berikut</p>
        </div>

        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Tanggal --}}
            <div>
                <label for="tanggal" class="block font-semibold mb-1">Tanggal Pergi</label>
                <input type="date" id="tanggal" name="tanggal" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
            </div>

            {{-- Kendaraan --}}
            <input type="hidden" name="kendaraan_id" value="{{ $selectedKendaraan->id }}">
            <div>
                <label for="jenis" class="block font-semibold mb-1">Jenis Mobil</label>
                <input type="text" id="jenis" value="{{ $selectedKendaraan->jenis }}" disabled
                    class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm text-gray-700 px-4 py-2">
            </div>

            {{-- Data Diri Pengguna --}}
            <div>
                <label for="nama" class="block font-semibold mb-1">Nama</label>
                <input type="text" id="nama" name="nama" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
            </div>

            <div>
                <label for="nomor_telepon" class="block font-semibold mb-1">No. Telp</label>
                <input type="tel" id="nomor_telepon" name="nomor_telepon" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
            </div>

            <div>
                <label for="tujuan" class="block font-semibold mb-1">Tujuan</label>
                <input type="text" id="tujuan" name="tujuan" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
            </div>

            {{-- Detail Mobil Saat Pergi --}}
            <div class="border-t pt-6">
                <h3 class="text-lg font-bold mb-4 text-gray-700">Detail Keberangkatan</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="jam_pergi" class="block font-semibold mb-1">Jam Pergi</label>
                        <input type="time" id="jam_pergi" name="jam_pergi" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>

                    <div>
                        <label for="km_pergi" class="block font-semibold mb-1">KM Kendaraan Pergi</label>
                        <input type="number" id="km_pergi" name="km_pergi" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
                    </div>

                    <div>
                        <label for="bensin_pergi" class="block font-semibold mb-1">Indikator Bensin Pergi</label>
                        <input type="file" id="bensin_pergi" name="bensin_pergi" accept="image/*"
                            class="w-full border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                    </div>

                    <div>
                        <label for="kondisi_body_pergi" class="block font-semibold mb-1">Kondisi Body Mobil Pergi</label>
                        <input type="file" id="kondisi_body_pergi" name="kondisi_body_pergi" accept="image/*"
                            class="w-full border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                    </div>

                    <div>
                        <label for="kondisi_dalam_pergi" class="block font-semibold mb-1">Kondisi Dalam Mobil Pergi</label>
                        <input type="file" id="kondisi_dalam_pergi" name="kondisi_dalam_pergi" accept="image/*"
                            class="w-full border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-md shadow-md transition">
                    Kirim Booking
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SweetAlert ketika sukses --}}
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Permintaan berhasil dikirim!',
            text: 'Tolong tunggu approval dari admin.',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection