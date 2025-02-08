<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\Kampanye;
use Illuminate\Support\Carbon;
use DB;

class BerandaController extends Controller
{
    public function index(){
        $kampanye = DB::table('kampanye')
        ->where('status', 'aktif')
        ->get();

        $pantauDonasi = DB::table('pantau_donasi')
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();

        return view('front.layouts.beranda', compact('kampanye', 'pantauDonasi'));
    }

    public function detail(string $id){
        $kampanye = DB::table('kampanye')
        ->where('kampanye.id', $id)
        ->get();
        return view('front.layouts.form-donasi', compact('kampanye'));
    }

    public function indexPantau()
    {
        $pantauDonasi = DB::table('pantau_donasi')
                          ->join('kampanye', 'pantau_donasi.kampanye_id', '=', 'kampanye.id')
                          ->select('pantau_donasi.*', 'kampanye.nama', 'kampanye.foto', 'kampanye.dana_terkumpul')
                          ->get();

        $kampanyeNonaktif = DB::table('kampanye')
                             ->where('status', 'nonaktif')
                             ->get();

        return view('front.layouts.pantau', compact('pantauDonasi', 'kampanyeNonaktif'));
    }
    public function detailPantau($id)
    {
        $pantauDonasi = DB::table('pantau_donasi')
            ->join('kampanye', 'pantau_donasi.kampanye_id', '=', 'kampanye.id')
            ->select('pantau_donasi.*', 'kampanye.nama as kampanye_nama', 'kampanye.dana_terkumpul', 'kampanye.status') // Tambahkan 'kampanye.status'
            ->where('pantau_donasi.id', $id)
            ->first();

        if (!$pantauDonasi) {
            return redirect()->route('pantau')->with('error', 'Data tidak ditemukan');
        }

        if ($pantauDonasi->tgl_penyaluran) {
            $pantauDonasi->tgl_penyaluran = Carbon::parse($pantauDonasi->tgl_penyaluran)
                ->locale('id')
                ->isoFormat('D MMMM YYYY');
        }

        return view('front.layouts.detail-pantau', compact('pantauDonasi'));
    }

}
