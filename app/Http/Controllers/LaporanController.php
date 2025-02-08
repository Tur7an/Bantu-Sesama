<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Kampanye;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $kampanye = DB::table('kampanye')->get();
        return view ('admin.laporan.index', compact('kampanye'));
    }

    public function show(string $id)
    {
        $kampanye = DB::table('kampanye')
        ->where('kampanye.id', $id)
        ->get()
        ->map(function ($tanggal) {
            $tanggal->batas_tanggal = Carbon::parse($tanggal->batas_tanggal)
                ->locale('id')
                ->isoFormat('D MMMM YYYY');
            return $tanggal;
        });
        return view('admin.laporan.detail-laporan', compact('kampanye'));
    }

    public function eksporPdf()
    {
        $kampanye = Kampanye::all();

        $currentDateTime = Carbon::now('Asia/Jakarta')->format('d-m-Y H:i:s');

        $html = '
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
            }
            .kop-surat {
                text-align: center;
                margin-bottom: 20px;
            }
            .kop-surat h1 {
                margin: 0;
                font-size: 18px;
            }
            .kop-surat p {
                margin: 0;
                font-size: 14px;
                color: #555;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid #999;
            }
            th {
                background-color: #f2f2f2;
                color: #000;
                text-align: center;
                font-weight: bold;
            }
            td {
                text-align: center;
                padding: 8px;
            }
            .footer {
                margin-top: 20px;
                text-align: center;
                font-size: 12px;
                color: #666;
            }
        </style>
        <div class="kop-surat">
            <h1>Bantu Sesama</h1>
            <p>Alamat: Kota Bengkulu, Indonesia</p>
            <p>Telepon: +628 123 456 789 | Email: bantusesama@example.com</p>
        </div>
        <h2 style="text-align: center;">Laporan Kampanye Donasi</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Kampanye</th>
                    <th>Dana Terkumpul</th>
                    <th>Batas Tanggal</th>
                    <th>Target Dana</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($kampanye as $k) {
            $html .= '
                <tr>
                    <td>' . $k->nama . '</td>
                    <td>Rp' . number_format($k->dana_terkumpul, 0, ',', '.') . '</td>
                    <td>' . Carbon::parse($k->batas_tanggal)->locale('id')->isoFormat('D MMMM YYYY') . '</td>
                    <td>Rp' . number_format($k->batas_nominal, 0, ',', '.') . '</td>
                    <td>' . $k->status . '</td>
                </tr>';
        }

        $html .= '
            </tbody>
        </table>
        <div class="footer">
            <p>Laporan ini dibuat secara otomatis oleh sistem.</p>
            <p>Diunduh pada: ' . $currentDateTime . '</p>
        </div>';

        $pdf = Pdf::loadHTML($html);

        $fileName = 'laporan-kampanye-' . Carbon::now('Asia/Jakarta')->format('Y-m-d-H-i-s') . '.pdf';
        return $pdf->download($fileName);
    }
}
