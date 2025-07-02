<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Aplikasi Laravel')</title>

  {{-- Font Inter --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  {{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous" referrerpolicy="no-referrer" />


  @yield('styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
        margin: 0;
        padding: 0;
        color: #000;
        font-family: 'Inter', sans-serif;
        }

        .topnav {
        background-color: #fff;
        padding: 0.75rem 1.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 999;
        }

        .topnav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        }

        /* Logo */
        .logo {
        padding: 5px;
        transition: 0.3s;
        }
        .logo img {
        height: 50px;
        width: auto;
        display: block;
        }

        /* Toggle Button (hamburger) */
        #toggle-btn {
        background: none;
        border: none;
        color: black;
        font-size: 1.5rem;
        display: none;
        cursor: pointer;
        }

        /* Navigation Menu */
        .nav-menu {
        display: flex;
        list-style: none;
        gap: 1rem;
        margin: 0;
        padding: 0;
        }

        .nav-menu li a {
        color: black;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
        }

        .nav-menu li a:hover {
        background-color: rgba(230, 138, 0, 0.884);
        color: #ffffff;
        }

        /* === Responsive === */
        @media (max-width: 768px) {
        .nav-menu {
            display: block;
            flex-direction: column;
            position: fixed;
            top: 0;
            right: -100%; /* Awalnya tersembunyi di luar layar */
            width: 50%;
            height: 100vh;
            background-color: #fff;
            padding-top: 5rem;
            box-shadow: -2px 0 6px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 998;
        }

        .nav-menu.show {
            right: 0; /* Slide dari kanan */
        }

        .nav-menu li {
            padding: 1rem;
            text-align: left;
        }

        .nav-menu li a {
            display: block;
            padding: 0.75rem 1rem;
            width: 100%;
        }

        #toggle-btn {
            display: block;
            z-index: 999;
            position: relative;
        }
        }
    </style>
</head>

    <body>
        {{-- Sidebar di sini --}}
        <nav class="topnav">
        <div class="topnav-container">
            <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
            </a>
            </div>

            <button id="toggle-btn" class="nav-toggle">☰</button>

          <ul id="topnav-menu" class="nav-menu">
              <li><a href="{{ route('user.dashboard') }}" class="text-sm px-4 py-2 rounded-md inline-block hover:bg-blue-200">Beranda</a></li>
            <li><a href="{{ route('user.booking') }}" class="text-sm px-4 py-2 rounded-md inline-block hover:bg-blue-200">Booking</a></li>
            <li><a href="{{ route('user.kontak') }}" class="text-sm px-4 py-2 rounded-md inline-block hover:bg-blue-200">Kontak</a></li>
    
    @auth
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-md inline-flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </li>
    @endauth
</ul>

        </div>
        </nav>

        {{-- Konten utama --}}

        {{-- Konten halaman --}}
            @yield('content')

    @yield('scripts')
    <script src="{{ asset('js/navbar.js') }}"></script>
    </body>
</html>
