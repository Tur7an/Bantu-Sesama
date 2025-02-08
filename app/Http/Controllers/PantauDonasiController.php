<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampanye;
use App\Models\PantauDonasi;
use Illuminate\Support\Carbon;
use DB;

class PantauDonasiController extends Controller
{

    public function index()
    {
        $pantauKampanye = Kampanye::whereIn('status', ['nonaktif', 'selesai'])
            ->get()
            ->map(function ($tanggal) {
                $tanggal->batas_tanggal = Carbon::parse($tanggal->batas_tanggal)
                    ->locale('id')
                    ->isoFormat('D MMMM YYYY');
                return $tanggal;
            });
        return view('admin.pantau-donasi.index', compact('pantauKampanye'));
    }

    public function create($kampanye_id)
    {
        $kampanye = Kampanye::findOrFail($kampanye_id);
        return view('admin.pantau-donasi.create', compact('kampanye'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kampanye_id' => 'required|exists:kampanye,id',
            'tgl_penyaluran' => 'required|date',
            'deskripsi' => 'required',
            'foto_penyaluran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filename = 'pantau-' . uniqid() . '.' . $request->foto_penyaluran->extension();
        $request->foto_penyaluran->move(public_path('admin/assets/images/pantauDonasi'), $filename);

        DB::table('pantau_donasi')->insert([
            'kampanye_id' => $request->kampanye_id,
            'tgl_penyaluran' => $request->tgl_penyaluran,
            'deskripsi' => $request->deskripsi,
            'foto_penyaluran' => $filename,
        ]);

        DB::table('kampanye')
            ->where('id', $request->kampanye_id)
            ->update(['status' => 'selesai']);

        return redirect()->route('pantau-donasi')->with('success', 'Penyaluran donasi berhasil ditambahkan.');
    }
}
