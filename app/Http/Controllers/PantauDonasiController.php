<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampanye;
use DB;

class PantauDonasiController extends Controller
{
    public function pantauDonasi()
    {
        // Ambil kampanye dengan status non-aktif
        $nonAktifKampanye = Kampanye::where('status', 'nonaktif')->get();

        return view('admin.pantau-donasi.index', compact('nonAktifKampanye'));
    }

}
