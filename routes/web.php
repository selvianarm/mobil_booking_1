<?php

use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\KendaraanController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserDashboardController;

// Home
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    if (!Auth::check()) return redirect()->route('login');

    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');

// Auth Routes (custom login & register)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [App\Http\Controllers\User\KendaraanController::class, 'index'])->name('user.dashboard');
});

//user dashboard
Route::get('/user/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('user.dashboard')->middleware(['auth', 'role:user']);
// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Optional logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Kendaraan
    Route::resource('kendaraan', \App\Http\Controllers\Admin\KendaraanController::class);
    Route::get('kendaraan/{id}/detail', [\App\Http\Controllers\Admin\KendaraanController::class, 'show'])->name('kendaraan.detail');

    // Karyawan
    Route::resource('karyawan', KaryawanController::class);
    Route::get('karyawan/{id}/detail', [KaryawanController::class, 'detail'])->name('karyawan.detail');

    // Booking approval
    Route::get('bookings', [BookingAdminController::class, 'index'])->name('booking.index');
    Route::post('booking/{id}/approve', [AdminDashboardController::class, 'approve'])->name('booking.approve');
    Route::post('booking/{id}/rejected', [AdminDashboardController::class, 'reject'])->name('booking.rejected');

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('laporan/{id}/download', [LaporanController::class, 'downloadPdf'])->name('laporan.download');
    Route::get('/laporan/pdf/{id}',   [LaporanController::class, 'downloadPdf'])->name('laporan.detail.pdf');
    Route::get('/laporan/export-all', [LaporanController::class, 'exportAll'])->name('laporan.exportAll'); 
});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/kendaraan', [App\Http\Controllers\User\KendaraanController::class, 'index'])
         ->name('user.kendaraan.index');
});

Route::middleware(['auth', 'role:user'])->prefix('booking')->name('booking.')->group(function () {
    Route::get('/create/{id}', [BookingController::class, 'create'])->name('create');
    Route::post('/store', [BookingController::class, 'store'])->name('store');
});


Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/booking/create/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{kendaraan}/detail', [DashboardController::class, 'show'])->name('booking.detail');
    Route::get('/booking/return/{id}', [BookingController::class, 'showReturnForm'])->name('booking.return');
    Route::patch('/booking/{booking}/return', [BookingController::class, 'return'])->name('user.booking.return');
    Route::post('/booking/return/{id}', [BookingController::class, 'storeReturn'])->name('booking.return.store');
});

//status di user

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.user');


// laporan
//mendownload jadi file pdf
Route::get('/export-pdf', [PDFController::class, 'export']);
Route::get('/admin/laporan/{id}/download', [LaporanController::class, 'downloadPdf'])->name('admin.laporan.download');