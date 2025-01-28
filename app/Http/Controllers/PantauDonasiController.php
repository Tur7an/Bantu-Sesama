<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampanye;
use App\Models\PantauDonasi;
use DB;

class PantauDonasiController extends Controller
{
    public function index()
    {
        // Ambil kampanye dengan status non-aktif
        $nonAktifKampanye = Kampanye::where('status', 'nonaktif')->get();
        return view('admin.pantau-donasi.index', compact('nonAktifKampanye'));
    }

    public function create($kampanye_id)
    {
        $kampanye = Kampanye::findOrFail($kampanye_id);
        return view('admin.pantau-donasi.create', compact('kampanye'));
    }

    public function store(Request $request)
    {
        // Validasi form input
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tgl_penyaluran' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'kampanye_id' => 'required|exists:kampanye,id',
        ]);

        // Menyimpan data pantau donasi ke tabel pantau_donasi
        $pantauDonasi = new PantauDonasi();
        $pantauDonasi->kampanye_id = $request->kampanye_id;
        $pantauDonasi->tgl_penyaluran = $request->tgl_penyaluran;
        $pantauDonasi->deskripsi = $request->deskripsi;

        // Menyimpan foto penyaluran jika ada
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('pantau_donasi_images');
            $pantauDonasi->img = $imagePath;
        }

        $pantauDonasi->save();

        // Update status kampanye menjadi non-aktif
        $kampanye = Kampanye::find($request->kampanye_id);
        $kampanye->status = 'non-aktif';
        $kampanye->save();

        return redirect()->route('pantau-donasi.index')->with('success', 'Pantau Donasi berhasil ditambahkan!');
    }
}
