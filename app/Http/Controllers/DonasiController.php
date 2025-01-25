<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Kampanye;
use DB;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $donasi = Donasi::join('kampanye', 'kampanye_id', '=', 'kampanye.id')
        // ->select('donasi.*', 'kampanye.nama as kampanye')
        // ->get();
        // // $donasi = DB::table('donasi')->get();
        // return view ('admin.dashboard', compact('donasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $kampanye = DB::table('kampanye')->get();
        // return view('front.layouts.form-donasi', compact('kampanye'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil kampanye berdasarkan ID
    $kampanye = DB::table('kampanye')->where('id', $request->kampanye_id)->first();

    if (!$kampanye) {
        return back()->with('error', 'Kampanye tidak ditemukan.');
    }
        // Hitung sisa target donasi
    $sisaTarget = $kampanye->batas_nominal - $kampanye->dana_terkumpul;

    // Validasi apakah nominal donasi melebihi batas
    if ($request->nominal_donasi > $sisaTarget) {
        return back()->with('error', 'Nominal donasi melebihi target yang dibutuhkan. Sisa target: Rp ' . number_format($sisaTarget, 0, ',', '.'));
    }

        //Tambah Donasi
         DB::table('donasi')->insert([
        'kampanye_id' => $request->kampanye_id,
        'nama_donatur' => $request->nama_donatur,
        'nominal_donasi' => $request->nominal_donasi,
        'waktu_donasi' => now(),
    ]);

    // Mengupdate total dana_terkumpul
    DB::table('kampanye')
    ->where('id', $request->kampanye_id)
    ->increment('dana_terkumpul', $request->nominal_donasi);

    return redirect()->route('beranda')->with('success', 'Terima kasih atas donasi Anda!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
