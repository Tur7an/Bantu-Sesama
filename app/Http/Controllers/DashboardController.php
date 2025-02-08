<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Kampanye;
use DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
    $donasi = DB::table('donasi')
    ->join('kampanye', 'donasi.kampanye_id', '=', 'kampanye.id')
    ->select('donasi.*', 'kampanye.nama as nama_kampanye')
    ->orderBy('donasi.waktu_donasi', 'desc')
    ->take(10)
    ->get()
    ->map(function ($tanggal) {
        $tanggal->waktu_donasi = Carbon::parse($tanggal->waktu_donasi)
            ->locale('id')
            ->isoFormat('D MMMM YYYY HH:mm:ss');
        return $tanggal;
    });
        return view('admin.dashboard', compact('donasi'));
    }
}
