@extends('layouts.app')

@section('title', 'Form Booking Kendaraan')

@section('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Navbar CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <!-- Booking CSS -->
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endsection

@section('content')
<div class="booking-wrapper">
    <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="booking-form">
        @csrf

        <div class="form-title">
            <h1>Form Booking</h1>
            <h3>Tolong isi dan lengkapi data berikut</h3>
        </div>

        {{-- Tanggal --}}
        <div class="form-group">
            <label for="tanggal">Tanggal Pergi:</label>
            <input type="date" id="tanggal" name="tanggal" required>
        </div>

        {{-- Kendaraan --}}
        <div class="form-group">
            <input type="hidden" name="kendaraan_id" value="{{ $selectedKendaraan->id }}">
            <label for="jenis" class="form-label">Jenis Mobil</label>
            <input type="text" class="form-control" id="jenis" value="{{ $selectedKendaraan->jenis }}" disabled>
        </div>

        {{-- Data Diri Pengguna --}}
        <div class="form-group">
            <label for="nama">Nama :</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="nomor_telepon">No. Telp :</label>
            <input type="tel" id="nomor_telepon" name="nomor_telepon" required>
        </div>

        <div class="form-group">
            <label for="tujuan">Tujuan :</label>
            <input type="text" id="tujuan" name="tujuan" required>
            
        </div>
        
        {{-- Detail Mobil Saat Pergi --}}
        <fieldset class="form-section">
            <div class="form-row">
                <div class="form-group">
                    <label for="jam_pergi">Jam Pergi :</label>
                    <input type="time" id="jam_pergi" name="jam_pergi" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="km_pergi">KM Kendaraan Pergi :</label>
                    <input type="number" id="km_pergi" name="km_pergi" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="bensin_pergi">Indikator Bensin Pergi :</label>
                    <input type="file" id="bensin_pergi" name="bensin_pergi" accept="image/*">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kondisi_body_pergi">Kondisi Body Mobil Pergi :</label>
                    <input type="file" id="kondisi_body_pergi" name="kondisi_body_pergi" accept="image/*">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kondisi_dalam_pergi">Kondisi Dalam Mobil Pergi :</label>
                    <input type="file" id="kondisi_dalam_pergi" name="kondisi_dalam_pergi" accept="image/*">
                </div>
            </div>

        </fieldset>

        <button type="submit" class="btn-submit">Kirim Booking</button>
    </form>
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
