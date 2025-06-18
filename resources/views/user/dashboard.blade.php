@extends('layouts.app')

@section('title', 'Dashboard User')

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Dashboard CSS -->
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

<head>
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<!-- Header Section -->
<header class="relative bg-cover bg-center h-screen" style="background-image: url('/images/latar.jpg'); font-family:  Poppins', 'Arial', sans-serif;">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black bg-opacity-60"></div>

  <!-- Content -->
  <div class="relative z-10 flex flex-col justify-center items-start h-full px-6 md:px-24 text-white">
    <h1 class="text-4xl md:text-5xl font-extrabold max-w-xl leading-tight">
      PERJALANAN LANCAR, KINERJA MAKSIMAL
    </h1>
    <p class="mt-4 text-lg max-w-lg">
      Kami percaya bahwa mobilitas yang baik akan menciptakan pekerjaan yang hebat
    </p>
    <div class="mt-6 flex space-x-4">
      <a href="#mulai"
         class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md shadow-md transition">
        MULAI
      </a>
    </div>
  </div>
</header>

@section('content')

<div class="dashboard-container">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-car"></i>
            </div>
{{-- <div class="stat-number">{{ $availableCars }}</div> --}}
            <div class="stat-label">Mobil Tersedia</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #4ecdc4, #44a08d);">
                <i class="fas fa-calendar-check"></i>
            </div>
{{-- <div class="stat-number">{{ $activeBookingCount }}</div> --}}
            <div class="stat-label">Booking Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #a8edea, #fed6e3);">
                <i class="fas fa-clock"></i>
            </div>
{{-- <div class="stat-number">{{ $pendingApprovals }}</div> --}}
            <div class="stat-label">Menunggu Approval</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #ffecd2, #fcb69f);">
                <i class="fas fa-chart-line"></i>
            </div>
{{-- <div class="stat-number">{{ $totalTrips }}</div> --}}
            <div class="stat-label">Total Perjalanan</div>
        </div>
    </div>

    <div id="booking">
        <x-katalog-kendaraan :kendaraans="$kendaraans" :activeBookings="$activeBookings" />
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
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

<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-200 py-10 mt-16 w-screen relative left-0 right-0">
                <div id="kontak">
                  <!-- Kontainer konten: lebar tengah, tapi footer tetap full -->
                  <div class="max-w-screen-xl mx-auto px-6 py-10">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                    <!-- Kolom 1 -->
                    <div>
                      <h4 class="font-bold text-white mb-4">PERUSAHAAN</h4>
                      <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="#" class="hover:underline">Karir</a></li>
                        <li><a href="#kontak" class="hover:underline">Kontak Kami</a></li>
                        <li><a href="#" class="hover:underline">Menjadi Mitra</a></li>
                      </ul>
                    </div>
              
                    <!-- Kolom 2 -->
                    <div>
                      <h4 class="font-bold text-white mb-4">LAYANAN</h4>
                      <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Penyewaan Mobil</a></li>
                        <li><a href="#" class="hover:underline">Layanan Supir</a></li>
                        <li><a href="#" class="hover:underline">Event Korporat</a></li>
                      </ul>
                    </div>
              
                    <!-- Kolom 3 -->
                    <div>
                      <h4 class="font-bold text-white mb-4">KONTAK</h4>
                      <ul class="space-y-2">
                        <li><i class="fas fa-envelope text-blue-400 mr-2"></i><a href="sales@bintangmas-engineering.com
                            " class="hover:underline">sales@bintangmas-engineering.com
                        </a></li>
                        <li><i class="fas fa-phone text-blue-400 mr-2"></i><a href="tel:+6221 82732142" class="hover:underline">+6221 82732142</a></li>
                        <li><i class="fas fa-map-marker-alt text-blue-400 mr-2"></i>Jawa Barat, Indonesia</li>
                        <li>
                          <i class="fas fa-globe text-blue-400 mr-2"></i>
                          <a href="https://bintangmas-engineering.com/" target="_blank" class="hover:underline text-blue-300">bintangmas-engineering.com</a>
                        </li>
                      </ul>
                    </div>
              
                    <!-- Kolom 4 -->
                    <div>
                      <h4 class="font-bold text-white mb-4">IKUTI KAMI</h4>
                      <div class="flex space-x-4 text-blue-400 text-xl">
                        <a href="https://www.linkedin.com/company/pt-bintang-mas-karya-nusantara/" class="hover:text-white"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.facebook.com/bmknengineering" class="hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/BMKN_Engineering/" class="hover:text-white"><i class="fab fa-instagram"></i></a>
                      </div>
                    </div>
              
                  </div>
                </div>
              
                <!-- Copyright -->
                <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-400 px-6">
                    &copy; 2025 List Mobil Anda. All rights reserved.
                </div>
              </footer>

@endsection
@section('scripts')
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

