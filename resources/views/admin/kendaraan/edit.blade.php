@extends('layouts.admin')

@section('title', 'Admin- Edit Kendaraan')

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

<div class="card-glass text-gray-800"> 
    <h2 class="mb-4">Edit Kendaraan</h2> 
    <form action="{{ route('admin.kendaraan.update', $kendaraans->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3"> 
            <label for="jenis" class="form-label">Jenis Kendaraan</label> 
            <input type="text" name="jenis" id="jenis" class="form-control bg-white text-dark" value="{{ old('jenis', $kendaraans->jenis) }}" required>
            @error('jenis') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Kendaraan</label>
            @if ($kendaraans->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $kendaraans->foto) }}" alt="Foto kendaraan" class="w-32 h-24 object-cover">
                </div>
            @endif
            <input type="file" name="foto" id="foto" class="w-full border p-2 rounded">
            @error('foto') <small class="text-red-600">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div> 
@endsection


