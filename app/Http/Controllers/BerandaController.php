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

    public function panggil($id)
    {
        T_antrian::find($id)->update([
            'status' => 1,
        ]);
        return back();
    }

    public function periksa($id)
    {
        T_antrian::find($id)->update([
            'status' => 2,
        ]);
        return back();
    }

    public function selesai($id)
    {
        T_antrian::find($id)->update([
            'status' => 3,
        ]);
        return back();
    }

    public function lewati($id)
    {
        T_antrian::find($id)->update([
            'status' => 4,
        ]);
        return back();
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
