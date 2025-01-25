<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Kampanye;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data donasi menggunakan Query Builder
        // Ambil 10 data donasi terbaru, termasuk nama kampanye
    $donasi = DB::table('donasi')
    ->join('kampanye', 'donasi.kampanye_id', '=', 'kampanye.id')  // Join dengan tabel kampanye
    ->select('donasi.*', 'kampanye.nama as nama_kampanye')  // Pilih data donasi dan nama kampanye
    ->orderBy('donasi.waktu_donasi', 'desc')  // Urutkan berdasarkan waktu_donasi terbaru
    ->take(10)  // Batasi hanya 10 data terbaru
    ->get();

// Kirim data ke view
return view('admin.dashboard', compact('donasi'));
    }
}
