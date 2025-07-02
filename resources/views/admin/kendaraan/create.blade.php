@extends('layouts.admin')

@section('title', 'Admin - Tambah Kendaraan')

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Dashboard Custom CSS -->
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
        margin: 20px auto; 
        max-width: 600px; 
    }

    .card-glass h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1f2937;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
    }

    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }

    .btn-success:hover {
        background-color: #157347;
        border-color: #146c43;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
        border-color: #565e64;
    }
</style> 

<div class="card-glass"> 
    <h2 class="text-center mb-4">Tambah Kendaraan</h2> 

    <form action="{{ route('admin.kendaraan.store') }}" method="POST" enctype="multipart/form-data"> 
        @csrf 
        
        <div class="mb-3"> 
            <label for="jenis" class="form-label">Jenis Kendaraan</label> 
            <input type="text" name="jenis" id="jenis" class="form-control bg-white text-dark" value="{{ old('jenis') }}" required> 
            @error('jenis')<small class="text-danger">{{ $message }}</small> @enderror 
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Kendaraan</label>
            <input type="file" name="foto" id="foto" class="w-full border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-orange-500 file:text-white hover:file:bg-orange-600">
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Kendaraan</label>
            <select name="status" id="status" class="form-select bg-white text-dark" required>
                <option value="">-- Pilih Status --</option>
                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                <option value="rusak" {{ old('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Simpan
            </button>
            <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div> 
@endsection
