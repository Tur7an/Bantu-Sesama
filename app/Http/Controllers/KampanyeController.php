<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampanye;
use DB;
use Illuminate\Support\Carbon;

class KampanyeController extends Controller
{
    public function index()
    {
        $this->updateStatusKampanye();
        $aktifKampanye = Kampanye::where('status', 'aktif')
        ->get()
        ->map(function ($tanggal) {
            $tanggal->batas_tanggal = Carbon::parse($tanggal->batas_tanggal)
                ->locale('id')
                ->isoFormat('D MMMM YYYY');
            return $tanggal;
        });
        return view('admin.kampanye.index', compact('aktifKampanye'));
    }

    public function create()
    {
        $kampanye = DB::table('kampanye')->get();
        return view('admin.kampanye.create', compact('kampanye'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'deskripsi' => 'required',
            'batas_nominal' => 'required',
            'batas_tanggal' => 'required',
            'status' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ],
        [
            'nama.max50' => 'Nama Maksimal 50 Karakter',
            'nama.required' => 'Nama Kampanye Wajib Diisi',
            'deskripsi.required' => 'Deskripsi Wajib Diisi',
            'batas_nominal.required' => 'Batas Nominal Wajib Diisi',
            'batas_nominal.numeric' => 'Batas Nominal Wajib Angka',
            'batas_tanggal.required' => 'Batas Tanggal Wajib Diisi',
            'batas_tanggal.numeric' => 'Batas Tanggal Wajib Angka',
            'foto.required' => 'Foto Wajib Diisi',
            'foto.max' => 'Foto Maksimal 2MB',
            'foto.mimes' => 'Format Foto Hanya Bisa .jpg, .png, .jpeg',
            'foto.image' => 'Foto Harus Berbentuk Image',
        ]
        );

        $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
        $request->foto->move(public_path('admin/assets/images/kampanye'), $fileName);

        DB::table('kampanye')->insert([
            'nama'=>$request->nama,
            'deskripsi'=>$request->deskripsi,
            'batas_nominal'=>$request->batas_nominal,
            'batas_tanggal'=>$request->batas_tanggal,
            'dana_terkumpul'=> 0,
            'status'=>$request->status,
            'foto' =>$fileName,
        ]);
        return redirect('admin/kampanye');
    }

    public function show(string $id)
    {
        $kampanye = DB::table('kampanye')
        ->where('kampanye.id', $id)
        ->get();
        return view('admin.kampanye.detail', compact('kampanye'));
    }

    public function edit(string $id)
    {
        $kampanye = DB::table('kampanye')->where('id', $id)->get();
        return view('admin.kampanye.edit', compact('kampanye'));
    }

    public function update(Request $request, string $id)
    {
        $fotoLama = DB::table('kampanye')->where('id', $id)->value('foto');
        if ($request->hasFile('foto')) {
            if (!empty($fotoLama) && file_exists(public_path('admin/assets/images/kampanye/' . $fotoLama))) {
                unlink(public_path('admin/assets/images/kampanye/' . $fotoLama));
            }
            $fileName = 'foto-' . uniqid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('admin/assets/images/kampanye'), $fileName);
        } else {
            $fileName = $fotoLama;
        }
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

    public function updateStatusKampanye()
    {
        $now = Carbon::now('Asia/Jakarta');

        DB::table('kampanye')
            ->where('batas_tanggal', '<', $now)
            ->where('status', 'aktif')
            ->update(['status' => 'nonaktif']);

        DB::table('kampanye')
            ->whereColumn('dana_terkumpul', '>=', 'batas_nominal')
            ->where('status', 'aktif')
            ->update(['status' => 'nonaktif']);
    }
}
