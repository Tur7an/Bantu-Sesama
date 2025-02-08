<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Kampanye;
use DB;
use Illuminate\Support\Carbon;

class DonasiController extends Controller
{
    public function store(Request $request)
{
    // Validasi request
    $request->validate([
        'kampanye_id' => 'required|exists:kampanye,id',
        'nama_donatur' => 'required|string|max:255',
        'nominal_donasi' => 'required|numeric|min:1000',
    ]);

    // Ambil data kampanye
    $kampanye = DB::table('kampanye')->where('id', $request->kampanye_id)->firstOrFail();

    // Cek apakah kampanye sudah nonaktif
    if ($kampanye->status !== 'aktif') {
        return back()->with('error', 'Kampanye sudah tidak menerima donasi.');
    }

    // Hitung sisa target donasi
    $sisaTarget = $kampanye->batas_nominal - $kampanye->dana_terkumpul;

    if ($request->nominal_donasi > $sisaTarget) {
        return back()->with('error', 'Nominal donasi melebihi target yang dibutuhkan. Sisa target: Rp ' . number_format($sisaTarget, 0, ',', '.'));
    }

    try {
        DB::beginTransaction();

        // Simpan donasi
        DB::table('donasi')->insert([
            'kampanye_id' => $request->kampanye_id,
            'nama_donatur' => $request->nama_donatur,
            'nominal_donasi' => $request->nominal_donasi,
            'waktu_donasi' => Carbon::now('Asia/Jakarta'),
        ]);

        // Update dana terkumpul pada kampanye
        DB::table('kampanye')->where('id', $request->kampanye_id)->update([
            'dana_terkumpul' => $kampanye->dana_terkumpul + $request->nominal_donasi,
        ]);

        // Update status kampanye jika target tercapai
        $this->updateStatusKampanye($kampanye->id);

        DB::commit();

        return back()->with('success', 'Terima kasih atas donasi Anda!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
    }
}


    private function updateStatusKampanye($kampanye_id)
    {
        $now = Carbon::now('Asia/Jakarta');

        // Ambil data kampanye terbaru setelah update dana terkumpul
        $kampanye = DB::table('kampanye')->where('id', $kampanye_id)->first();

        if ($kampanye) {
            // Jika batas tanggal sudah lewat, ubah status ke nonaktif
            if ($kampanye->batas_tanggal < $now && $kampanye->status == 'aktif') {
                DB::table('kampanye')
                    ->where('id', $kampanye_id)
                    ->update(['status' => 'nonaktif']);
            }

            // Jika total donasi mencapai atau melebihi batas nominal, ubah status ke nonaktif
            if ($kampanye->dana_terkumpul >= $kampanye->batas_nominal && $kampanye->status == 'aktif') {
                DB::table('kampanye')
                    ->where('id', $kampanye_id)
                    ->update(['status' => 'nonaktif']);
            }
        }
    }
}
