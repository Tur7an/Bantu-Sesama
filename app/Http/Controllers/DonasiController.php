<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Kampanye;
use Midtrans\Config;
use Midtrans\Snap;
use DB;
use Illuminate\Support\Carbon;

class DonasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kampanye_id' => 'required|exists:kampanye,id',
            'nama_donatur' => 'required|string|max:255',
            'nominal_donasi' => 'required|numeric|min:1000',
        ]);
        $kampanye = DB::table('kampanye')->where('id', $request->kampanye_id)->first();

        if (!$kampanye) {
            return response()->json(['error' => true, 'message' => 'Kampanye tidak ditemukan.'], 404);
        }

        if ($kampanye->status !== 'aktif') {
            return response()->json(['error' => true, 'message' => 'Kampanye sudah tidak menerima donasi.'], 400);
        }

        try {
            DB::beginTransaction();

            // Simpan donasi
            $donasiId = DB::table('donasi')->insertGetId([
                'kampanye_id' => $request->kampanye_id,
                'nama_donatur' => $request->nama_donatur,
                'nominal_donasi' => $request->nominal_donasi,
                'waktu_donasi' => Carbon::now('Asia/Jakarta'),
            ]);

            // Update total dana_terkumpul
            $totalDonasi = DB::table('donasi')
                ->where('kampanye_id', $request->kampanye_id)
                ->sum('nominal_donasi');

            DB::table('kampanye')
                ->where('id', $request->kampanye_id)
                ->update(['dana_terkumpul' => $totalDonasi]);

            // Konfigurasi Midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Buat order_id yang unik
            $orderId = 'DONASI-' . $donasiId . '-' . time();

            // Buat parameter untuk Midtrans Snap
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $request->nominal_donasi,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_donatur,
                    'email' => 'user@example.com',
                    'phone' => '08123456789',
                ],
            ];
            $snapToken = Snap::getSnapToken($params);

            DB::commit();

            return response()->json(['snap_token' => $snapToken]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }

    }
}
