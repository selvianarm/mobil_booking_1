@extends('layouts.admin')

@section('title', 'Admin - Tambah Karyawan')

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

    .form-label {
        font-weight: 600;
        color: #374151;
    }

    .btn-primary {
        background-color: #10b981;
        border-color: #10b981;
    }

    .btn-primary:hover {
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
    <h2>Tambah Karyawan</h2>

    <form action="{{ route('admin.karyawan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control bg-white text-dark" value="{{ old('nama') }}" required>
            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control bg-white text-dark" value="{{ old('jabatan') }}" required>
            @error('jabatan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control bg-white text-dark" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control bg-white text-dark" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary me-2">
            <i class="fas fa-save me-1"></i> Simpan
        </button>
        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </form>
</div>
@endsection
