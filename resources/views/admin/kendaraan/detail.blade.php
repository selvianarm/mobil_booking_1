@extends('layouts.admin')

@section('title', 'Admin - Detail Kendaraan')

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
<!-- Booking CSS -->
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
        color: rgb(0, 0, 0);
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

    .card-glass p {
        font-size: 1rem;
        color: #374151;
        text-align: center;
    }

    .preview-img {
        width: 180px;
        height: auto;
        border-radius: 0.5rem;
        object-fit: cover;
        margin: 1rem auto;
        display: block;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .btn-glass {
        background-color: #6b7280;
        color: white;
        padding: 0.6rem 1.4rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .btn-glass:hover {
        background-color: #4b5563;
    }

    .info-label {
        font-weight: 600;
    }
</style>

<div class="card-glass">
    <h2>Detail Kendaraan</h2>

    @if ($kendaraans->foto && file_exists(public_path('storage/' . $kendaraans->foto)))
        <img src="{{ asset('storage/' . $kendaraans->foto) }}" alt="Foto Kendaraan" class="preview-img">
    @else
        <p class="text-muted fst-italic">(Tidak ada foto)</p>
    @endif

    <p><span class="info-label">Jenis :</span> {{ $kendaraans->jenis }}</p>

    <div class="text-center mt-4">
        <a href="{{ route('admin.kendaraan.index') }}" class="btn-glass">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>
@endsection
