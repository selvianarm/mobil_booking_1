@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Tailwind sudah digunakan -->
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    /* Responsive iframe Google Maps */
    .map-responsive iframe {
        width: 100%;
        height: 300px;
        border: 0;
        border-radius: 0.5rem;
    }

    @media (min-width: 768px) {
        .map-responsive iframe {
            height: 450px;
        }
    }
</style>
@endsection

@section('content')

    <div class="max-w-screen-xl mx-auto px-6 py-20 mt-10" id="kontak">
    <div class="grid md:grid-cols-2 gap-8">
        {{-- Kiri: Info Kontak --}}
        <div class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-gray-100 p-4 rounded shadow text-center">
                    <i class="fas fa-phone fa-2x text-orange-500 mb-2"></i>
                    <div class="font-semibold">Phone</div>
                    <div class="text-sm text-gray-600">‪+6221 82732142‬</div>
                </div>
                <div class="bg-gray-100 p-4 rounded shadow text-center">
                    <i class="fab fa-whatsapp fa-2x text-green-500 mb-2"></i>
                    <div class="font-semibold">Whatsapp</div>
                    <div class="text-sm text-gray-600">‪+6221 82732142‬</div>
                </div>
                <div class="bg-gray-100 p-4 rounded shadow text-center">
                    <i class="fas fa-envelope fa-2x text-red-400 mb-2"></i>
                    <div class="font-semibold">Email</div>
                    <div class="text-sm text-gray-600">sales@bintangmas-engineering.com</div>
                </div>
                <div class="bg-gray-100 p-4 rounded shadow text-center">
                    <i class="fas fa-store fa-2x text-blue-400 mb-2"></i>
                    <div class="font-semibold">Alamat</div>
                    <div class="text-sm text-gray-600">Jaka Setia, Bekasi Selatan, Kota Bekasi, Jawa Barat 17147</div>
                </div>
            </div>

            <div class="map-responsive">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31727.579794885085!2d106.97321809305835!3d-6.270638191656697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1751277506579!5m2!1sen!2sus"
                    allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        {{-- Kanan: Form Kontak --}}
        <div>
            <h2 class="text-3xl font-bold mb-4">Get In Touch</h2>
    
            <form action="send_email.php" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Name"
                    class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-300">
                <input type="email" name="email" placeholder="Email"
                    class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-300">
                <input type="text" name="subject" placeholder="Subject"
                    class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-300">
                <textarea name="message" rows="4" placeholder="Message"
                    class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-300"></textarea>
                <button type="submit"
                    class="bg-orange-400 text-white px-6 py-3 rounded hover:bg-orange-500 transition">Send
                    Now</button>
            </form>
        </div>
    </div>
</div>


    {{-- Footer --}}
    <footer class="py-10 mt-16 w-screen relative left-0 right-0 bg-gray-900 text-white">
        <div class="max-w-screen-xl mx-auto px-6 py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="font-bold mb-4">PERUSAHAAN</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="#" class="hover:underline">Karir</a></li>
                        <li><a href="#kontak" class="hover:underline">Kontak Kami</a></li>
                        <li><a href="#" class="hover:underline">Menjadi Mitra</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">LAYANAN</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Penyewaan Mobil</a></li>
                        <li><a href="#" class="hover:underline">Layanan Supir</a></li>
                        <li><a href="#" class="hover:underline">Event Korporat</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">KONTAK</h4>
                    <ul class="space-y-2">
                        <li><i class="fas fa-envelope text-blue-400 mr-2"></i><a href="mailto:sales@bintangmas-engineering.com" class="hover:underline">sales@bintangmas-engineering.com</a></li>
                        <li><i class="fas fa-phone text-blue-400 mr-2"></i><a href="tel:+622182732142" class="hover:underline">+6221 82732142</a></li>
                        <li><i class="fas fa-map-marker-alt text-blue-400 mr-2"></i>Jawa Barat, Indonesia</li>
                        <li><i class="fas fa-globe text-blue-400 mr-2"></i><a href="https://bintangmas-engineering.com/" target="_blank" class="hover:underline text-blue-300">bintangmas-engineering.com</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">IKUTI KAMI</h4>
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
    </footer>

    {{-- SweetAlert Popups --}}
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
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
