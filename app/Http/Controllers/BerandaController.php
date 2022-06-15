<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\T_antrian;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $tgl = Carbon::now()->format('Y-m-d');

        $umum       = T_antrian::where('tanggal', $tgl)->where('kdPoli', '001')->get();
        $gigi       = T_antrian::where('tanggal', $tgl)->where('kdPoli', '002')->get();
        $lansia     = T_antrian::where('tanggal', $tgl)->where('kdPoli', '012')->get();
        $kia        = T_antrian::where('tanggal', $tgl)->where('kdPoli', '003')->get();
        return view('superadmin.beranda', compact('umum', 'gigi', 'lansia', 'kia'));
    }

    // public function updateurl(Request $req)
    // {
    //     BaseUrl::first()->update([
    //         'tpp' => $req->tpp,
    //         'presensi' => $req->presensi,
    //     ]);

    //     toastr()->success('Berhasil Di Update');
    //     return back();
    // }
}
