<?php

namespace App\Http\Controllers;

use App\Models\BaseUrl;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('superadmin.beranda');
    }

    public function updateurl(Request $req)
    {
        BaseUrl::first()->update([
            'tpp' => $req->tpp,
            'presensi' => $req->presensi,
        ]);

        toastr()->success('Berhasil Di Update');
        return back();
    }
}
