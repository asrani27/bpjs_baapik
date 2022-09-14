<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\M_provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function index()
    {
        $data = M_provider::get();
        return view('superadmin.master.provider.index', compact('data'));
    }

    public function create()
    {
        $data = null;
        return view('superadmin.master.provider.create', compact('data'));
    }

    public function wsGetProvider(Request $request)
    {

        $service = WSProvider('GET', 0, 100);

        if ($service == null) {
            toastr()->error('Data Tidak Ditemukan');
            $request->flash();
            return back();
        } else {
            $data = $service;
            $request->flash();
            toastr()->success('Data Ditemukan');

            return view('superadmin.master.provider.create', compact('data'));
        }
    }
    public function store(Request $request)
    {
        $data = json_decode($request->jsonDiag);
        foreach ($data as $i) {
            $check = M_provider::where('kdProvider', $i->kdProvider)->first();
            if ($check == null) {
                $n = new M_provider;
                $n->kdProvider = $i->kdProvider;
                $n->nmProvider = $i->nmProvider;
                $n->save();
            } else {
            }
        }
        toastr()->success('Berhasil Disimpan');
        $request->flash();
        return redirect('/datamaster/data/provider');
    }
}
