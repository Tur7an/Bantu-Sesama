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
        $request->validate([
            'kampanye_id' => 'required|exists:kampanye,id',
            'nama_donatur' => 'required|string|max:255',
            'nominal_donasi' => 'required|numeric|min:1000',
        ], [
            'nama_donatur.required' => 'Nama Donatur wajib diisi.',
            'nominal_donasi.required' => 'Nominal Donasi wajib diisi.',
            'nominal_donasi.numeric' => 'Nominal Donasi harus berupa angka.',
            'nominal_donasi.min' => 'Minimal Nominal Donasi adalah Rp. 1000.',
        ]);

        $kampanye = DB::table('kampanye')->where('id', $request->kampanye_id)->first();
        if (!$kampanye || $kampanye->status !== 'aktif') {
            return response()->json(['error' => true, 'message' => 'Kampanye tidak ditemukan atau tidak menerima donasi.'], 400);
        }

        try {
            DB::beginTransaction();

            $donasiId = DB::table('donasi')->insertGetId([
                'kampanye_id' => $request->kampanye_id,
                'nama_donatur' => $request->nama_donatur,
                'nominal_donasi' => $request->nominal_donasi,
                'waktu_donasi' => Carbon::now('Asia/Jakarta'),
                'status' => 'unpaid',
            ]);

            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $orderId = 'DONASI-' . $donasiId . '-' . time();
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
            return response()->json([
                'snap_token' => $snapToken,
                'success' => true,
                'message' => 'Donasi berhasil, silakan lanjutkan pembayaran!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => 'Terjadi kesalahan saat memproses donasi.', 'details' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        \Log::info('Midtrans Callback:', $request->all());

        $serverKey = config('midtrans.server_key');
        $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($signatureKey !== $request->signature_key) {
            return response()->json(['error' => true, 'message' => 'Invalid signature'], 403);
        }

        $orderId = explode('-', $request->order_id)[1];
        $kampanyeId = DB::table('donasi')->where('id', $orderId)->value('kampanye_id');

        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            DB::table('donasi')->where('id', $orderId)->update(['status' => 'paid']);

            // Hitung ulang total dana_terkumpul berdasarkan donasi dengan status 'paid'
            $totalDanaTerkumpul = DB::table('donasi')
                ->where('kampanye_id', $kampanyeId)
                ->where('status', 'paid')
                ->sum('nominal_donasi');

            DB::table('kampanye')
                ->where('id', $kampanyeId)
                ->update(['dana_terkumpul' => $totalDanaTerkumpul]);

            return response()->json(['success' => true, 'message' => 'Pembayaran berhasil!']);
        } elseif (in_array($request->transaction_status, ['pending', 'expire', 'cancel', 'deny'])) {
            DB::table('donasi')->where('id', $orderId)->update(['status' => 'unpaid']);
            return response()->json(['success' => false, 'message' => 'Pembayaran gagal atau kadaluarsa.']);
        }

        return response()->json(['success' => true]);
    }
}
