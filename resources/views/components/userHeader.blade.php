


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

    <div class="container">
        <div class="floating-elements">
            <div class="floating-circle circle-1"></div>
            <div class="floating-circle circle-2"></div>
            <div class="floating-circle circle-3"></div>
        </div>
        
        <div class="hero-section">
            <div class="content-left">

                <h1 class="hero-title">ROADSTER</h1>
                
                <p class="hero-subtitle">
                    Mobil tercepat di dunia dengan akselerasi rekor, jangkauan terdepan, dan performa yang tak tertandingi.
                </p>
                
                <div class="stats-container">
                    <div class="stat-item">
                        <div class="stat-number">{{ $availableCars  }}</div>
                        <div class="stat-label">Mobil Tersedia</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $activeBookingCount  }}</div>
                        <div class="stat-label">Booking Aktif</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $totalTrips  }}</div>
                        <div class="stat-label">Total Perjalanan</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $pendingApprovals  }}</div>
                        <div class="stat-label">Menunggu Approval</div>
                    </div>
                </div>
                
                <div class="cta-section">
                    <button class="reserve-btn"><a href="{{ route('user.dashboard') }}">PESAN SEKARANG</a></button>
                </div>
            </div>
            
            <div class="content-right">
                <img src="{{ asset('images/mobil.png') }}" alt="Roadster Car" class="car-image" loading="lazy">
            </div>
        </div>
    </div>

    {{-- dashboard --}}
    {{-- @include('user.dashboard') --}}

    {{-- FOOTER --}}
    {{-- @include('footer') --}}

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

    <script>
        // Add smooth scrolling and interactive elements
        document.querySelector('.reserve-btn').addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });

        // Parallax effect for floating elements
        document.addEventListener('mousemove', function(e) {
            const circles = document.querySelectorAll('.floating-circle');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            circles.forEach((circle, index) => {
                const speed = (index + 1) * 0.5;
                const xOffset = (x - 0.5) * speed * 20;
                const yOffset = (y - 0.5) * speed * 20;
                
                circle.style.transform = translate(${xOffset}px, ${yOffset}px);
            });
        });

        // Add counter animation on load
        function animateCounter(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const current = Math.floor(progress * (end - start) + start);
                element.textContent = current;
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Trigger animations on page load
        window.addEventListener('load', () => {
            const statNumbers = document.querySelectorAll('.stat-number');
            const values = [1.9, 400, 1000];
            
            statNumbers.forEach((stat, index) => {
                setTimeout(() => {
                    if (index === 0) {
                        let current = 0;
                        const increment = 1.9 / 100;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= 1.9) {
                                current = 1.9;
                                clearInterval(timer);
                            }
                            stat.textContent = current.toFixed(1);
                        }, 20);
                    } else {
                        animateCounter(stat, 0, values[index], 2000);
                    }
                }, index * 200);
            });
        });
    </script>

@endsection

@section('scripts')
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
