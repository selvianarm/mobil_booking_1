@extends('layouts.admin')

@section('title', 'Admin - Detail Karyawan')

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

    .info-item {
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .info-item strong {
        color: #374151;
        min-width: 80px;
        display: inline-block;
    }

    .btn-glass {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-glass:hover {
        background-color: #5c636a;
        color: white;
    }
</style>

<div class="card-glass">
    <h2>Detail Karyawan</h2>

    <p class="info-item"><strong>Nama:</strong> {{ $karyawan->nama }}</p>
    <p class="info-item"><strong>Jabatan:</strong> {{ $karyawan->jabatan }}</p>
    <p class="info-item"><strong>Email:</strong> {{ $karyawan->email }}</p>
    <p class="info-item"><strong>Role:</strong> {{ $karyawan->role }}</p>

    <div class="mt-4 text-center">
        <a href="{{ route('admin.karyawan.index') }}" class="btn-glass"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
    </div>
</div>
@endsection
