@extends('layouts.admin')

@section('title', 'Admin- Edit Booking')

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
    <h2 class="mb-4">Edit Booking</h2> 
    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('GET')
        <div class="mb-3">
            <h4>Booking oleh: {{ $booking->nama }}</h4>
        </div>

        <div class="mb-3">
            <p>Kendaraan awal: {{ $booking->kendaraan->nama }}</p>
            <img src="{{ asset('storage/' . $booking->kendaraan->foto) }}" width="150">
        </div>
        
        <div class="mb-3">
            <label>Kendaraan Pengganti</label>
            <select name="kendaraan_pengganti_id" required class="w-full p-2 rounded-md border border-gray-300 text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-purple-400">
                <option value="">-- Pilih Mobil Pengganti --</option>
                @foreach ($kendaraans as $mobil)
                    @if ($mobil->jenis != $booking->kendaraan_id && $mobil->status == 'tersedia')
                        <option value="{{ $mobil->id }}">{{ $mobil->jenis }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label>Catatan Admin</label>
            <select name="catatan_admin" required>
                <option value="">-- Tambahkan catatan --</option>
                <option value="rusak">Rusak</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div> 
@endsection
