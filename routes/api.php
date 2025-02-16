<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;

Route::post('/midtrans/callback', [DonasiController::class, 'midtransCallback']);
