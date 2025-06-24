@extends('layouts.admin')

@section('title', 'Booking Terbaru')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .dataTables_wrapper .dataTables_filter input {
            padding: 0.5rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-left: 0.5em;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 0.4rem;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 2px;
            border-radius: 8px;
            background: #f1f5f9;
            border: none;
            color: #333;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff !important;
            font-weight: bold;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 10px;
            font-size: 0.875rem;
        }

        .badge-status {
            padding: 4px 10px;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 999px;
            display: inline-block;
        }

        .bg-light {
            background: #e0f2ff;
            color: #0369a1;
        }

        .bg-success {
            background: #d1fae5;
            color: #065f46;
        }

        .bg-danger {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
@endsection

@section('content')

<main class="main-content">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4 border-b pb-4">
        <div class="flex items-center gap-2">
            <i class="fas fa-car text-2xl text-white-600"></i>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Kendaraan</h2>
        </div>
    </div>

    <section class="active fade-in" id="booking-section">
        <div class="content-section active">
            
            @if (session('success'))
                <div class="alert alert-success fade-in mb-4">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger fade-in mb-4">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if($bookings->isEmpty())
                <div class="alert alert-info text-center">Tidak ada booking yang sedang di gunakan</div>
            @else
            <div class="table-container">
                <table id="bookingTable" class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Karyawan</th>
                            <th>Kendaraan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>#BK{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $booking->nama ?? '-' }}</td>
                                <td>{{ $booking->kendaraan->jenis ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                                <!-- <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge-status bg-light">Menunggu</span>
                                    @elseif($booking->status == 'approved')
                                        <span class="badge-status bg-success">Disetujui</span>
                                    @else
                                        <span class="badge-status bg-danger">Ditolak</span>
                                    @endif
                                </td> -->
                                <td class="px-4 py-2">
                                    <span class="inline-block px-2 py-1 rounded text-white
                                        @if($booking->status == 'pending') bg-yellow-500
                                        @elseif($booking->status == 'approved') bg-green-600
                                        @elseif($booking->status == 'rejected') bg-red-600
                                        @elseif($booking->status == 'selesai') bg-blue-600
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </section>
</main>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#bookingTable').DataTable({
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari total _MAX_ data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                },
            }
        });
    });
</script>
@endsection
