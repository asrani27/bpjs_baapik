<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\M_kesadaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KesadaranController extends Controller
{
    public function index()
    {
        $data = M_kesadaran::get();
        return view('superadmin.master.kesadaran.index', compact('data'));
    }

    public function create()
    {
        $data = null;
        return view('superadmin.master.kesadaran.create', compact('data'));
    }

    public function wsGetSadar(Request $request)
    {
        $service = WSKesadaran('GET');

        if ($service == null) {
            toastr()->error('Data Tidak Ditemukan');
            $request->flash();
            return back();
        } else {
            $data = $service;
            $request->flash();
            toastr()->success('Data Ditemukan');
            return view('superadmin.master.kesadaran.create', compact('data'));
        }
    }

    public function store(Request $request)
    {
        $data = json_decode($request->jsonDiag);
        foreach ($data as $i) {
            $check = M_kesadaran::where('kdSadar', $i->kdSadar)->first();
            if ($check == null) {
                $n = new M_kesadaran;
                $n->kdSadar = $i->kdSadar;
                $n->nmSadar = $i->nmSadar;
                $n->save();
            } else {
            }
        }
        toastr()->success('Berhasil Disimpan');

        return redirect('/datamaster/data/kesadaran');
    }
}
