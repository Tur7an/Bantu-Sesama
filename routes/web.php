<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampanyeController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\UserController;


// Routing Landing Page
Route::get('/', function () {
    return view('front/layouts/beranda');
})->name('beranda');

Route::get('/pantau-donasi', function () {
    return view('front/layouts/pantau');
})->name('pantau-donasi');

Route::get('/tentang-kami', function () {
    return view('front/layouts/tentang');
})->name('tentang-kami');

Route::get('/detail-pantau', function () {
    return view('front/layouts/detail-pantau');
})->name('detail-pantau');

Route::get('/form-donasi', function () {
    return view('front/layouts/form-donasi');
})->name('form-donasi');


//Middleware
Route::group(['middleware' => ['auth']], function(){
//Routing Dashboard

Route::get('/dashboard', function(){
    return view('admin.dashboard');
});

Route::prefix('admin')->group(function(){
// Route::get('/kampanye', [KampanyeController::class, 'index']);
Route::resource('kampanye', KampanyeController::class);
Route::resource('donasi', DonasiController::class);
Route::get('/profile', [UserController::class, 'showProfile']);
});

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
