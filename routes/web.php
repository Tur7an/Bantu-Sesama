<?php

use Illuminate\Support\Facades\Route;


// Routing Landing Page
Route::get('/', function () {
    return view('front/home');
})->name('home');

Route::get('/pantau-donasi', function () {
    return view('front/pantau');
})->name('pantau-donasi');

Route::get('/tentang-kami', function () {
    return view('front/tentang');
})->name('tentang-kami');

Route::get('/detail-pantau', function () {
    return view('front/detail-pantau');
})->name('detail-pantau');

Route::get('/form-donasi', function () {
    return view('front/form-donasi');
})->name('form-donasi');

//Routing Dashboard

Route::get('/dashboard', function(){
    return view('admin.dashboard');
});
