@extends('layouts.admin')

@section('title', 'Booking Terbaru')

@section('styles')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    

    <style>
        table {
            border-collapse: separate;
            border-spacing: 0;
        }

        thead th {
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            color: #333;
            border-bottom: 2px solid #ccc;
        }

        tbody tr:hover {
            background-color: #f1faff;
            transition: background 0.3s ease;
        }

        tbody td {
            border-bottom: 1px solid #eee;
        }

        tbody td img {
            transition: transform 0.2s ease;
        }

        tbody td img:hover {
            transform: scale(1.05);
        }

        .aksi-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }

        .aksi-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .aksi-link i {
            transition: transform 0.2s ease-in-out;
        }

        .aksi-link:hover i {
            transform: scale(1.1);
        }
    </style>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4 border-b pb-4">
        <div class="flex items-center gap-2">
            <i class="fas fa-car text-2xl text-white-600"></i>
            <h2 class="text-2xl font-bold text-gray-800">Booking Terbaru</h2>
        </div>

    </div>

    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle me-1"></i>{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle me-1"></i>{{ session('error') }}</div>
    @endif

    @if($bookings->isEmpty())
        <div class="alert alert-info text-center">Tidak ada booking yang menunggu persetujuan.</div>
    @else

    <div class="bg-white rounded-xl shadow-lg overflow-x-auto border border-blue-100">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gradient-to-r from-cyan-100 to-blue-50">
                <tr>
                    <th class="px-5 py-3 font-semibold text-blue-800">Id</th>
                    <th class="px-5 py-3 font-semibold text-blue-800">Karyawan</th>
                    <th class="px-5 py-3 font-semibold text-blue-800">Kendaraan</th>
                    <th class="px-5 py-3 font-semibold text-blue-800">Tanggal</th>
                    <th class="px-5 py-3 font-semibold text-blue-800">Status</th>
                    <th class="px-5 py-3 font-semibold text-blue-800">Aksi</th>

                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr class="odd:bg-white even:bg-blue-50 hover:bg-blue-100 transition">
                        <td class="px-5 py-4">#BK{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-5 py-4">{{ $booking->nama ?? '-' }}</td>
                        <td class="px-5 py-4">{{ $booking->kendaraan->jenis ?? '-' }}</td>
                        <td class="px-5 py-4">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                        <td class="px-5 py-4 font-medium">
                            @if($booking->status == 'pending')
                                <span class="badge-status bg-light text-primary">Menunggu</span>
                            @elseif($booking->status == 'approved')
                                <span class="badge-status bg-success text-white">Disetujui</span>
                            @else
                                <span class="badge-status bg-danger text-white">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.booking.approve', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                            </form>
                        
                            <form action="{{ route('admin.booking.rejected', $booking->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">Rejected</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
