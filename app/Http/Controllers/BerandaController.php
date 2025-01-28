<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\Kampanye;
use DB;

class BerandaController extends Controller
{
    public function index(){
        $kampanye = DB::table('kampanye')
        ->where('status', 'aktif')
        ->get();
        return view ('front.layouts.beranda', compact('kampanye'));
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
                          ->select('pantau_donasi.*', 'kampanye.nama', 'kampanye.foto')
                          ->get();

        $kampanyeNonaktif = DB::table('kampanye')
                             ->where('status', 'nonaktif')
                             ->get();

        return view('front.layouts.pantau', compact('pantauDonasi', 'kampanyeNonaktif'));
    }
}
