<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampanye;
use DB;

class KampanyeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kampanye = DB::table('kampanye')->get();
        return view ('admin.kampanye.index', compact('kampanye'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kampanye = DB::table('kampanye')->get();
        return view('admin.kampanye.create', compact('kampanye'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Upload Foto
        $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
        $request->foto->move(public_path('admin/assets/images/kampanye'), $fileName);

        // Tambah Data
        DB::table('kampanye')->insert([
            'nama'=>$request->nama,
            'deskripsi'=>$request->deskripsi,
            'batas_nominal'=>$request->batas_nominal,
            'batas_tanggal'=>$request->batas_tanggal,
            'status'=>$request->status,
            'foto' =>$fileName,
        ]);
        return redirect('admin/kampanye');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kampanye = DB::table('kampanye')
        ->where('kampanye.id', $id)
        ->get();
        return view('admin.kampanye.detail', compact('kampanye'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Menampilkan Data Update
        $kampanye = DB::table('kampanye')->where('id', $id)->get();
        return view('admin.kampanye.edit', compact('kampanye'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Mendapatkan foto lama dari database
    $fotoLama = DB::table('kampanye')->where('id', $id)->value('foto'); // Langsung ambil nilai

    // Jika ada foto baru diunggah
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if (!empty($fotoLama) && file_exists(public_path('admin/assets/images/kampanye/' . $fotoLama))) {
            unlink(public_path('admin/assets/images/kampanye/' . $fotoLama));
        }

        // Upload foto baru
        $fileName = 'foto-' . uniqid() . '.' . $request->foto->extension();
        $request->foto->move(public_path('admin/assets/images/kampanye'), $fileName);
    } else {
        // Jika tidak ada foto baru, gunakan foto lama
        $fileName = $fotoLama;
    }

    // Update data di database
    DB::table('kampanye')->where('id', $id)->update([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'batas_nominal' => $request->batas_nominal,
        'batas_tanggal' => $request->batas_tanggal,
        'status' => $request->input('status', 'aktif'),
        'foto' => $fileName,
    ]);

    return redirect('admin/kampanye')->with('success', 'Data berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
