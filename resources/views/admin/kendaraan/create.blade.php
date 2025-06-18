@extends('layouts.admin')

@section('title', 'Admin- Tambah Kendaraan')

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Booking CSS -->
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
<style> 
    .card-glass { 
        background: rgba(255, 255, 255, 0.06); 
        border-radius: 16px; 
        padding: 25px; 
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3); 
        backdrop-filter: blur(10px); 
        color: white; 
        margin: 20px auto; 
        max-width: 600px; 
    } 
</style> 

<div class="card-glass"> 
    <h2 class="mb-4">Tambah Kendaraan</h2> 
    <form action="{{ route('admin.kendaraan.store') }}" method="POST" enctype="multipart/form-data"> 
        @csrf 
        <div class="mb-3"> 
            <label for="jenis" class="form-label">Jenis Kendaraan</label> 
            <input type="text" name="jenis" id="jenis" class="form-control" value="{{ old('jenis') }}" required> 
            @error('jenis')<small class="text-danger">{{ $message }}</small> @enderror 
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Kendaraan</label>
            <input type="file" name="foto" id="foto" class="form-control">
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div> 
@endsection

