<?php
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiDetailController;
use App\Http\Controllers\TransaksiController;

use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

// Default route untuk yang belum login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest-only routes (untuk login dan register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated-only routes (hanya setelah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard atau halaman utama setelah login
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Menu barang hanya bisa diakses jika login
    Route::resource('barang', BarangController::class);
    Route::resource('pelanggan', PelangganController::class)->middleware('auth');
    Route::resource('transaksidetail', TransaksiDetailController::class)->middleware('auth');
    Route::resource('transaksi', TransaksiController::class)->middleware('auth');
    Route::get('/laporan/transaksi', [App\Http\Controllers\LaporanController::class, 'transaksi'])->name('laporan.transaksi');
    Route::get('/laporan/transaksi', [App\Http\Controllers\LaporanController::class, 'cetakTransaksi'])->name('laporan.transaksi');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

});


