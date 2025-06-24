@extends('layouts.app')

@section('title', 'Form Pengembalian Kendaraan')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endsection

@section('content')
<div class="booking-wrapper">
    <form action="{{ route('user.booking.return.store', $booking->id) }}" method="POST" enctype="multipart/form-data" class="booking-form">
        @csrf
        <div class="form-title">
            <h1>Form Pengembalian</h1>
            <h3>Harap isi data kondisi kendaraan saat dikembalikan</h3>
        </div>

        {{-- Data booking --}}
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" value="{{ $booking->nama }}" disabled>
        </div>

        <div class="form-group">
            <label for="kendaraan">Jenis Kendaraan:</label>
            <input type="text" id="kendaraan" value="{{ $booking->kendaraan->jenis ?? '-' }}" disabled>
        </div>

        <div class="form-group">
            <label for="km_pulang">KM Pulang:</label>
            <input type="number" id="km_pulang" name="km_pulang" required>
        </div>

        <div class="form-group">
            <label for="jam_pulang">Jam Pulang:</label>
            <input type="time" id="jam_pulang" name="jam_pulang" required>
        </div>

        <div class="form-row">
            <label>Indikator Bensin Pulang:</label>
            <input type="file" name="bensin_pulang" accept="image/*">
        </div>

        <div class="form-row">
            <label>Kondisi Body Pulang:</label>
            <input type="file" name="kondisi_body_pulang" accept="image/*">
        </div>

        <div class="form-row">
            <label>Kondisi Dalam Pulang:</label>
            <input type="file" name="kondisi_dalam_pulang" accept="image/*">
        </div>

        <button type="submit" class="btn-submit">Submit Pengembalian</button>
    </form>
</div>

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
