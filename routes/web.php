<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect root ke dashboard (otomatis ke login jika belum masuk)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Guest Routes (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Authenticated Routes (Wajib Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Placeholder sementara untuk menu sidebar (akan diganti di Tahap 5 & 6)
    Route::get('/customers', fn () => 'Halaman Pelanggan (Tahap 5)')->name('customers.index');
    Route::get('/services', fn () => 'Halaman Layanan (Tahap 5)')->name('services.index');
    Route::get('/transactions', fn () => 'Halaman Transaksi (Tahap 6)')->name('transactions.index');
});