@extends('layouts.admin')

@section('title', 'Admin - Edit Booking')

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .card-glass {
        background: rgb(255, 255, 255);
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        color: #111827;
        margin: 40px auto;
        max-width: 600px;
    }

    .card-glass h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1f2937;
        text-align: center;
    }

    label {
        font-weight: 600;
        color: #374151;
    }

    select, input[type="text"] {
        background-color: #fff;
        color: #111827;
    }

    .booking-info {
        background-color: #f9fafb;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        border-left: 4px solid #f97316;
    }

    .btn-success {
        background-color: #10b981;
        border-color: #10b981;
    }

    .btn-success:hover {
        background-color: #059669;
        border-color: #059669;
    }

    .btn-secondary {
        background-color: #6b7280;
        border-color: #6b7280;
    }

    .btn-secondary:hover {
        background-color: #4b5563;
        border-color: #4b5563;
    }
</style>

<div class="card-glass">
    <h2>Edit Booking</h2>

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('GET')

        <div class="booking-info mb-3">
            <strong>Booking oleh:</strong> {{ $booking->nama }} <br>
            <strong>Kendaraan awal:</strong> {{ $booking->kendaraan->jenis ?? '-' }} <br>
            @if ($booking->kendaraan->foto)
                <img src="{{ asset('storage/' . $booking->kendaraan->foto) }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <div class="mb-3">
            <label for="kendaraan_pengganti_id">Kendaraan Pengganti</label>
            <select name="kendaraan_pengganti_id" id="kendaraan_pengganti_id" required class="form-select">
                <option value="">-- Pilih Mobil Pengganti --</option>
                @foreach ($kendaraans as $mobil)
                    @if ($mobil->id != $booking->kendaraan_id && $mobil->status == 'tersedia')
                        <option value="{{ $mobil->id }}">{{ $mobil->jenis }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="catatan_admin">Catatan Admin</label>
            <select name="catatan_admin" id="catatan_admin" class="form-select" required>
                <option value="">-- Tambahkan catatan --</option>
                <option value="rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success me-2">
            <i class="fas fa-save me-1"></i> Simpan
        </button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Batal
        </a>
    </form>
</div>
@endsection
