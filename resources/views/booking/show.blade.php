@extends('layouts.admin')

@section('content')
<h1>Detail Booking</h1>

<p><strong>Tanggal:</strong> {{ $booking->tanggal }}</p>
<p><strong>Nama User:</strong> {{ $booking->user->name ?? '-' }}</p>
<p><strong>Nomor Telepon:</strong> {{ $booking->nomor_telepon }}</p>
<p><strong>Tujuan:</strong> {{ $booking->tujuan }}</p>
<p><strong>Status:</strong> {{ $booking->status }}</p>

<hr>
<h3>Foto Kendaraan - Pergi</h3>
@if($booking->bensin_pergi_url)
    <p><strong>Bensin Pergi:</strong></p>
    <img src="{{ $booking->bensin_pergi_url }}" style="max-width: 200px;">
@endif

@if($booking->kondisi_body_pergi_url)
    <p><strong>Kondisi Body Pergi:</strong></p>
    <img src="{{ $booking->kondisi_body_pergi_url }}" style="max-width: 200px;">
@endif

@if($booking->kondisi_dalam_pergi_url)
    <p><strong>Kondisi Dalam Pergi:</strong></p>
    <img src="{{ $booking->kondisi_dalam_pergi_url }}" style="max-width: 200px;">
@endif

<hr>
<h3>Foto Kendaraan - Pulang</h3>
@if($booking->bensin_pulang_url)
    <p><strong>Bensin Pulang:</strong></p>
    <img src="{{ $booking->bensin_pulang_url }}" style="max-width: 200px;">
@endif

@if($booking->kondisi_body_pulang_url)
    <p><strong>Kondisi Body Pulang:</strong></p>
    <img src="{{ $booking->kondisi_body_pulang_url }}" style="max-width: 200px;">
@endif

@if($booking->kondisi_dalam_pulang_url)
    <p><strong>Kondisi Dalam Pulang:</strong></p>
    <img src="{{ $booking->kondisi_dalam_pulang_url }}" style="max-width: 200px;">
@endif
@endsection
