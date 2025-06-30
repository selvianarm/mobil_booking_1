


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

    {{-- DASHBOARD --}}
    {{-- @include('dashboard.user') --}}

    <footer class="bg-gray-900 text-gray-200 py-10 mt-16 w-screen relative left-0 right-0">
        <div id="kontak">
            <div class="max-w-screen-xl mx-auto px-6 py-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <h4 class="font-bold text-white mb-4">PERUSAHAAN</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                            <li><a href="#" class="hover:underline">Karir</a></li>
                            <li><a href="#kontak" class="hover:underline">Kontak Kami</a></li>
                            <li><a href="#" class="hover:underline">Menjadi Mitra</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-white mb-4">LAYANAN</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:underline">Penyewaan Mobil</a></li>
                            <li><a href="#" class="hover:underline">Layanan Supir</a></li>
                            <li><a href="#" class="hover:underline">Event Korporat</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-white mb-4">KONTAK</h4>
                        <ul class="space-y-2">
                            <li><i class="fas fa-envelope text-blue-400 mr-2"></i><a href="mailto:sales@bintangmas-engineering.com" class="hover:underline">sales@bintangmas-engineering.com</a></li>
                            <li><i class="fas fa-phone text-blue-400 mr-2"></i><a href="tel:+622182732142" class="hover:underline">+6221 82732142</a></li>
                            <li><i class="fas fa-map-marker-alt text-blue-400 mr-2"></i>Jawa Barat, Indonesia</li>
                            <li><i class="fas fa-globe text-blue-400 mr-2"></i><a href="https://bintangmas-engineering.com/" target="_blank" class="hover:underline text-blue-300">bintangmas-engineering.com</a></li>
                        </ul>
                    </div>

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

            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-400 px-6">
                &copy; Booking Mobil PT. Bintang Mas Karya Nusantara.
            </div>
        </div>
    </footer>


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
