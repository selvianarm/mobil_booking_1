@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endsection


@section('content')

<!-- Main Content -->
<main class="main-content">
    <div class="welcome-header fade-in">
        <h1>Selamat Datang di Dashboard Admin</h1>
        <p>Sistem Manajemen Booking Mobil Kantor</p>
    </div>

    <!-- Dashboard Section -->
    <section class="active fade-in" id="dashboard-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-number">{{ $availableCars  }}</div>
                <div class="stat-label">Total Mobil</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-number">{{ $activeBookingCount  }}</div>
                <div class="stat-label">Booking Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ef5350, #e53935);">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-number">{{ $rejectedCount }}</div>
                <div class="stat-label">Booking Rejected</div>
            </div>
        </div>

       <!-- Booking Terbaru -->
        <div class="content-section active">
            <div class="section-header">
                <h2 class="section-title">Booking Terbaru</h2>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Peminjam</th>
                            <th>Mobil</th>
                            <th>Mobil Pengganti</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>Catatan Admin</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>#BK{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $booking->nama ?? '-' }}</td>
                                <td>{{ $booking->kendaraan->jenis ?? '-' }}</td>
                                <td>{{ $booking->kendaraanPengganti->jenis ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
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
                                <td>
                                    <form action="{{ route('admin.booking.approve', $booking->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.booking.rejected', $booking->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                </td>
                                <td>{{ $booking->catatan_admin ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.booking.show', $booking->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium mr-2">
                                        <i class="fas fa-eye"></i> Detail
                                    </a> 
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="aksi-link text-yellow-600">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6">Belum ada booking menunggu persetujuan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</main>
@endsection

@section('scripts')
<script>
    document.getElementById('mobileMenuToggle').addEventListener('click', function () {
        document.getElementById('mobileNav').classList.toggle('active');
    });

    // Toggle mobile menu
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });

</script>
@endsection
