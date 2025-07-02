<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(ellipse at center, rgb(238, 187, 125) 0%, rgba(230, 138, 0, 0.884) 70%);
            min-height: 100vh;
            color: #333;
        }
        
        /* Navigasi utama */
        .top-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #000000; /* navy gelap */
            padding: 10px 20px;
            color: white;
            position: relative;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logo-icon {
            font-size: 30px;
            color: #f8bb38; /* biru cerah */
        }
        .logo h2 {
            font-weight: 700;
            font-size: 20px;
        }
        .logo h2 span {
            color: #f8bb38;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
            
            .section-header {
                flex-direction: column;
                align-items: stretch;
            }
        }
            

        /* Hamburger menu (hidden desktop) */
        .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            display: none;
        }

        /* Menu navigasi */
        .nav-menu {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        /* Item dan link */
        .nav-item {
        }
        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.3s ease;
        }
        .nav-link:hover,
        .nav-link:focus {
            color: #f8bb38;
        }

        /* User profile / logout */
        .user-profile form {
            margin: 0;
        }
        .logout-btn {
            background: #ef4444; /* merah */
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background: #dc2626;
        }

        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: radial-gradient(ellipse at center, rgb(238, 187, 125) 0%, rgba(230, 138, 0, 0.884) 70%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgb(0, 0, 0);
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #333;
        }

        .user-role {
            font-size: 0.8rem;
            color: #666;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #667eea;
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Main Content */
        .main-content {
            padding: 2rem;
            min-height: calc(100vh - 70px);
        }

        .welcome-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            text-align: center;
        }

        .welcome-header h1 {
            color: #333;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: radial-gradient(ellipse at center, rgb(230, 138, 0, 0.884) 0%, rgba(230, 138, 0, 0.884) 70%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-header p {
            color: #666;
            font-size: 1.1rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: radial-gradient(ellipse at center, rgb(238, 187, 125) 0%, rgba(230, 138, 0, 0.884) 70%);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Content Sections */
        .content-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .section-header {
            padding: 2rem 2rem 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        /* Tables */
        .table-container {
            padding: 2rem;
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            min-width: 800px;
        }

        .data-table th {
            background: radial-gradient(ellipse at right, rgb(238, 187, 125) 0%, rgba(230, 138, 0, 0.884) 100%);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .data-table tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-available {
            background: #d4edda;
            color: #155724;
        }

        .status-used {
            background: #f8d7da;
            color: #721c24;
        }

        .status-maintenance {
            background: #fff3cd;
            color: #856404;
        }

        .status-pending {
            background: #cce7ff;
            color: #004085;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        /* Forms */
        .form-container {
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1001;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .modal-body {
            padding: 2rem;
        }

        /* Mobile Navigation */
        .mobile-nav {
            display: none;
            position: fixed;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 999;
            padding: 1rem;
        }

        .mobile-nav.active {
            display: block;
        }

        .mobile-nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .mobile-nav-link {
            padding: 1rem;
            text-decoration: none;
            color: #555;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .mobile-nav-link:hover, .mobile-nav-link.active {
            background: radial-gradient(ellipse at center, rgb(238, 187, 125) 0%, rgba(230, 138, 0, 0.884) 70%);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
            
            .section-header {
                flex-direction: column;
                align-items: stretch;
            }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-menu {
                flex-direction: column;
                background-color: #1e293b;
                position: absolute;
                right: 0;
                width: 200px;
                border-radius: 4px;
                overflow: hidden;
                max-height: 0;
                transition: max-height 0.3s ease;
                box-shadow: 0 2px 8px rgb(0 0 0 / 0.3);
            }

            .nav-menu.active {
                max-height: 500px; /* cukup besar untuk semua item */
            }

            .nav-item {
                padding: 12px 20px;
                border-bottom: 1px solid #334155;
            }

            .nav-link {
                width: 100%;
                padding: 0;
            }

            /* User profile pindah ke bawah */
            .user-profile {
                display: none; /* bisa disesuaikan kalau mau tampil di mobile */
            }

            .top-nav {
                padding: 0 1rem;
            }

            .nav-menu {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .user-info {
                display: none;
            }

            .main-content {
                padding: 1rem;
            }

            .welcome-header h1 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-container {
                padding: 1rem;
            }

            .section-header {
                padding: 1.5rem 1rem 1rem;
            }

            .form-container {
                padding: 1rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .top-nav {
                height: 60px;
            }

            .main-content {
                margin-top: 60px;
                padding: 0.5rem;
            }

            .welcome-header {
                padding: 1.5rem;
            }

            .welcome-header h1 {
                font-size: 1.75rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
            }

            .data-table {
                font-size: 0.85rem;
            }

            .data-table th,
            .data-table td {
                padding: 0.75rem 0.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Smooth animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-menu {
                flex-direction: column;
                background-color: #1e293b;
                position: absolute;
                top: 60px;
                right: 0;
                width: 200px;
                border-radius: 4px;
                overflow: hidden;
                max-height: 0;
                transition: max-height 0.3s ease;
                box-shadow: 0 2px 8px rgb(0 0 0 / 0.3);
            }

            .nav-menu.active {
                max-height: 500px; /* cukup besar untuk semua item */
            }

            .nav-item {
                padding: 12px 20px;
                border-bottom: 1px solid #334155;
            }

            .nav-link {
                width: 100%;
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navigation -->
    <nav class="top-nav">
        <div class="logo-section">
            <div class="logo">
                <i class="fa-solid fa-car logo-icon"></i>
                <h2 class="nav-link">Booking <span>Car</span></h2>
            </div>
        </div>

        <!-- Tombol toggle -->
        <button class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navigation Menu -->
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.kendaraan.index') }}" class="nav-link"><i class="fas fa-car"></i> Kelola Mobil</a>
            </li>
            {{-- <li class="nav-item">
                <a href="{{ route('admin.sopir.index') }}" class="nav-link"><i class="fas fa-user-tie"></i> Kelola Supir</a>
            </li> --}}
            <li class="nav-item">
                <a href="{{ route('admin.booking.index') }}" class="nav-link"><i class="fas fa-calendar-check"></i> Booking</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.karyawan.index') }}" class="nav-link"><i class="fas fa-users"></i> Karyawan</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.laporan.index') }}" class="nav-link"><i class="fas fa-chart-bar"></i> Laporan</a>
            </li>
        </ul>

        <!-- User Profile -->
        <div class="user-profile">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    <div class="mobile-nav" id="mobileNav">
        <ul class="mobile-nav-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="mobile-nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.kendaraan.index') }}" class="mobile-nav-link"><i class="fas fa-car"></i> Kelola Mobil</a></li>
            {{-- <li><a href="{{ route('admin.sopir.index') }}" class="mobile-nav-link"><i class="fas fa-user-tie"></i> Kelola Supir</a></li> --}}
            <li><a href="{{ route('admin.booking.index') }}" class="mobile-nav-link"><i class="fas fa-calendar-check"></i> Booking</a></li>
            <li><a href="{{ route('admin.karyawan.index') }}" class="mobile-nav-link"><i class="fas fa-users"></i> Karyawan</a></li>
            <li><a href="{{ route('admin.laporan.index') }}" class="mobile-nav-link"><i class="fas fa-chart-bar"></i> Laporan</a></li>
        </ul>
    </div>

    <main>
        @yield('content')
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('nav-menu');

        if (toggle && menu) {
            toggle.addEventListener('click', function () {
                menu.classList.toggle('active');
            });
        }
    });

    const mobileToggle = document.getElementById('menu-toggle');
    const mobileNav = document.getElementById('mobileNav');

    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', function () {
            mobileNav.classList.toggle('active');
        });
    }

</script>

@yield('scripts')

</body>
</html>
