@extends('layouts.admin')

@section('title', 'Admin - Edit Karyawan')

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
    <h2 class="text-center mb-4">Edit Karyawan</h2> 

    <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3"> 
            <label for="nama" class="form-label">Nama</label> 
            <input type="text" name="nama" id="nama" class="form-control bg-white text-dark" value="{{ $karyawan->nama }}" required>
            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3"> 
            <label for="jabatan" class="form-label">Jabatan</label> 
            <input type="text" name="jabatan" id="jabatan" class="form-control bg-white text-dark" value="{{ $karyawan->jabatan }}" required>
            @error('jabatan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3"> 
            <label for="email" class="form-label">Email</label> 
            <input type="email" name="email" id="email" class="form-control bg-white text-dark" value="{{ $karyawan->email }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Update
            </button>
            <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div> 
@endsection
