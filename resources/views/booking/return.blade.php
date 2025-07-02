@extends('layouts.app')

@section('title', 'Form Pengembalian Kendaraan')

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
<div class="max-w-3xl mx-auto px-6 py-12 mt-20">
    <div class="bg-white p-8 rounded-2xl shadow-md">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Form Pengembalian</h1>
            <p class="text-gray-500">Harap isi data kondisi kendaraan saat dikembalikan</p>
        </div>

        <form action="{{ route('user.booking.return.store', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Data Booking --}}
            <div>
                <label class="block font-semibold mb-1">Nama</label>
                <input type="text" value="{{ $booking->nama }}" disabled
                    class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm text-gray-700 px-4 py-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Jenis Kendaraan</label>
                <input type="text" value="{{ $booking->kendaraan->jenis ?? '-' }}" disabled
                    class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm text-gray-700 px-4 py-2">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_pulang" class="block font-semibold mb-1">Tanggal Pengembalian</label>
                    <input type="date" id="tanggal_pulang" name="tanggal_pulang" value="{{ date('Y-m-d') }}" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
                </div>

                <div>
                    <label for="jam_pulang" class="block font-semibold mb-1">Jam Pulang</label>
                    <input type="time" id="jam_pulang" name="jam_pulang" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
                </div>

                <div>
                    <label for="km_pulang" class="block font-semibold mb-1">KM Pulang</label>
                    <input type="number" id="km_pulang" name="km_pulang" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-400 focus:border-orange-400">
                </div>
            </div>

            {{-- Upload Bukti --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6">
                <div>
                    <label for="bensin_pulang" class="block font-semibold mb-1">Indikator Bensin Pulang</label>
                    <input type="file" id="bensin_pulang" name="bensin_pulang" accept="image/*"
                        class="w-full border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                </div>

                <div>
                    <label for="kondisi_body_pulang" class="block font-semibold mb-1">Kondisi Body Pulang</label>
                    <input type="file" id="kondisi_body_pulang" name="kondisi_body_pulang" accept="image/*"
                        class="w-full border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                </div>

                <div>
                    <label for="kondisi_dalam_pulang" class="block font-semibold mb-1">Kondisi Dalam Pulang</label>
                    <input type="file" id="kondisi_dalam_pulang" name="kondisi_dalam_pulang" accept="image/*"
                        class="w-full border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-md shadow-md transition">
                    Submit Pengembalian
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SweetAlert ketika sukses --}}
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Pengembalian Berhasil!',
            text: 'Data pengembalian telah tercatat.',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
