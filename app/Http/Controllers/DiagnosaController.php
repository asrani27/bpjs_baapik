<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\M_diagnosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosaController extends Controller
{
    public function index()
    {
        $data = M_diagnosa::paginate(10);
        return view('superadmin.master.diagnosa.index', compact('data'));
    }

    public function add()
    {
        $data = null;
        return view('superadmin.master.diagnosa.add', compact('data'));
    }

    public function store(Request $request)
    {
        $data = json_decode($request->jsonDiag);
        foreach ($data as $i) {
            $check = M_diagnosa::where('kdDiag', $i->kdDiag)->first();
            if ($check == null) {
                $n = new M_diagnosa;
                $n->kdDiag = $i->kdDiag;
                $n->nmDiag = $i->nmDiag;
                $n->nonSpesialis = $i->nonSpesialis == false ? 0 : 1;
                $n->save();
            } else {
            }
        }
        toastr()->success('Berhasil Disimpan');
        $request->flash();
        return redirect('/datamaster/data/diagnosa/add');
    }
    public function wsGetDiagnosa(Request $request)
    {

        $service = WSDiagnosa('GET', $request->cari = null ? '' : $request->cari, 0, 10000);

        if ($service == null) {
            toastr()->error('Data Tidak Ditemukan');
            $request->flash();
            return back();
        } else {
            $data = $service;
            $request->flash();
            toastr()->success('Data Ditemukan');
            return view('superadmin.master.diagnosa.add', compact('data'));
        }
    }
}
