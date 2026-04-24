<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return view('pasien.dashboard');
});

// ─── AUTH ROUTES (hanya untuk guest / belum login) ─────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

// ─── LOGOUT ────────────────────────────────────────────────────────────────
Route::get('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout.get');
    
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── PASIEN ROUTES (harus login + role pasien) ─────────────────────────────
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/', [PasienController::class, 'dashboard'])->name('pasien.dashboard');

    Route::get('/konsultasi-chatbot', [PasienController::class, 'konsultasiChatbot'])->name('pasien.konsultasi-chatbot');
    Route::get('/jadwal-dokter', [PasienController::class, 'jadwalDokter'])->name('pasien.jadwal-dokter');
    Route::get('/informasi-rs', [PasienController::class, 'informasiRs'])->name('pasien.informasi-rs');
    Route::get('/faq', [PasienController::class, 'faq'])->name('pasien.faq');
    Route::get('/profil', [PasienController::class, 'profil'])->name('pasien.profil');
    Route::post('/profil', [PasienController::class, 'profilUpdate'])->name('pasien.profil.update');

    // Booking Konsultasi
    Route::get('/booking', [PasienController::class, 'bookingIndex'])->name('pasien.booking.index');
    Route::post('/booking', [PasienController::class, 'bookingStore'])->name('pasien.booking.store');
    Route::patch('/booking/{id}/cancel', [PasienController::class, 'bookingCancel'])->name('pasien.booking.cancel');
});

// ─── ADMIN ROUTES (harus login + role admin) ───────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Jadwal Dokter API
    Route::get('/admin/jadwal-dokter', [AdminController::class, 'jadwalDokter'])->name('admin.jadwal-dokter');

    // Booking Konsultasi
    Route::get('/admin/booking',             [AdminController::class, 'bookingIndex'])->name('admin.booking.index');
    Route::patch('/admin/booking/{id}/approve',[AdminController::class, 'bookingApprove'])->name('admin.booking.approve');

    // CRUD Manajemen User
    Route::get('/admin/users',              [AdminController::class, 'userIndex'])->name('admin.users.index');
    Route::get('/admin/users/create',       [AdminController::class, 'userCreate'])->name('admin.users.create');
    Route::post('/admin/users',             [AdminController::class, 'userStore'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit',    [AdminController::class, 'userEdit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}',         [AdminController::class, 'userUpdate'])->name('admin.users.update');
    Route::delete('/admin/users/{id}',      [AdminController::class, 'userDestroy'])->name('admin.users.destroy');

    // CRUD Data Pasien
    Route::get('/admin/pasien',              [AdminController::class, 'pasienIndex'])->name('admin.pasien.index');
    Route::get('/admin/pasien/create',       [AdminController::class, 'pasienCreate'])->name('admin.pasien.create');
    Route::post('/admin/pasien',             [AdminController::class, 'pasienStore'])->name('admin.pasien.store');
    Route::get('/admin/pasien/{id}',         [AdminController::class, 'pasienShow'])->name('admin.pasien.show');
    Route::get('/admin/pasien/{id}/edit',    [AdminController::class, 'pasienEdit'])->name('admin.pasien.edit');
    Route::put('/admin/pasien/{id}',         [AdminController::class, 'pasienUpdate'])->name('admin.pasien.update');
    Route::delete('/admin/pasien/{id}',      [AdminController::class, 'pasienDestroy'])->name('admin.pasien.destroy');
});