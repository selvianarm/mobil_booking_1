@extends('layouts.app')

@section('title', 'Dashboard User')

@section('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')

    {{-- HEADER --}}
    {{-- @include('components.userHeader') --}}

    <div class="dashboard-container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-car"></i></div>
                <div class="stat-number">{{ $availableCars }}</div>
                <div class="stat-label">Mobil Tersedia</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #4ecdc4, #44a08d);">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-number">{{ $activeBookingCount }}</div>
                <div class="stat-label">Booking Aktif</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ffecd2, #fcb69f);">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-number">{{ $totalTrips }}</div>
                <div class="stat-label">Total Perjalanan</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #a8edea, #fed6e3);">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $pendingApprovals }}</div>
                <div class="stat-label">Menunggu Approval</div>
            </div>
        </div>

        <div id="booking">
            <x-katalog-kendaraan :kendaraans="$kendaraans" :activeBookings="$activeBookings" />

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {{-- FOOTER --}}
    {{-- @include('components.footer') --}}

    {{-- SweetAlert Popups --}}
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Booking Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Kembali'
            });
        </script>
    @endif

@endsection

@section('scripts')
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
