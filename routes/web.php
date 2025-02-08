<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampanyeController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PantauDonasiController;

// Routing Landing Page
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/pantau-donasi', [BerandaController::class, 'indexPantau'])->name('pantau');
Route::get('/form-donasi/{id}', [BerandaController::class, 'detail']);
Route::resource('donasi', DonasiController::class);
Route::get('/tentang-kami', function () {return view('front.layouts.tentang');})->name('tentang-kami');
Route::get('/konfirmasi-donasi', function () {return view('front.layouts.konfirmasi-donasi');})->name('konfirmasi-donasi');
Route::get('/pantau-donasi/{id}', [BerandaController::class, 'detailPantau'])->name('detail-pantau');
Route::get('/form-donasi', function () {return view('front.layouts.form-donasi');})->name('form-donasi');

// Middleware untuk Routing Dashboard
Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Prefix admin untuk routing admin
    Route::prefix('admin')->group(function () {
        Route::resource('kampanye', KampanyeController::class);
        Route::get('/profile', [UserController::class, 'showProfile'])->name('admin.profile');
        Route::patch('profile/{id}', [UserController::class, 'update'])->name('admin.profile.update');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/laporan', [LaporanController::class, 'index']);
        Route::get('/detail-laporan/{id}', [LaporanController::class, 'show'])->name('detail-laporan');
        Route::get('/laporan-pdf', [LaporanController::class, 'eksporPdf'])->name('laporan.pdf');
        Route::get('/pantau-donasi', [PantauDonasiController::class, 'index'])->name('pantau-donasi');
        Route::get('pantau-donasi/{kampanye_id}/create', [PantauDonasiController::class, 'create'])->name('pantau-donasi.create');
        Route::post('/pantau-donasi/store', [PantauDonasiController::class, 'store'])->name('pantau-donasi.store');
    });
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
