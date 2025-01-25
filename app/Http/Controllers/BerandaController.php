<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\Kampanye;
use DB;

class BerandaController extends Controller
{
    public function index(){
        $kampanye = DB::table('kampanye')->get();
        return view ('front.layouts.beranda', compact('kampanye'));
    }

    public function detail(string $id){
        $kampanye = DB::table('kampanye')
        ->where('kampanye.id', $id)
        ->get();
        return view('front.layouts.form-donasi', compact('kampanye'));
    }
}
