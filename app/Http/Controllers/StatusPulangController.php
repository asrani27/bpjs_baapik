<?php

namespace App\Http\Controllers;

use App\Models\M_status_pulang;
use Illuminate\Http\Request;

class StatusPulangController extends Controller
{
    public function index()
    {
        $data = M_status_pulang::get();
        return view('superadmin.master.statuspulang.index', compact('data'));
    }

    public function create()
    {
        $data = null;
        return view('superadmin.master.statuspulang.create', compact('data'));
    }

    public function getstatus()
    {
        toastr()->error('Coba Lagi');
        return redirect('/datamaster/data/statuspulang/add');
    }
    public function wsGetStatusPulang(Request $request)
    {
        try {
            $service = WSStatusPulang('GET', $request->param1);

            if ($service == null) {
                toastr()->error('Data Tidak Ditemukan');
                $request->flash();
                return back();
            } else {
                $data = $service;
                $request->flash();
                toastr()->success('Data Ditemukan');
                return view('superadmin.master.statuspulang.create', compact('data'));
            }
        } catch (\Exception $e) {
            toastr()->error('Coba Lagi');
            return back();
        }
    }
    public function store(Request $request)
    {
        $data = json_decode($request->jsonDiag);
        foreach ($data as $i) {
            $check = M_status_pulang::where('kdStatusPulang', $i->kdStatusPulang)->first();
            if ($check == null) {
                $n = new M_status_pulang;
                $n->kdStatusPulang = $i->kdStatusPulang;
                $n->nmStatusPulang = $i->nmStatusPulang;
                $n->save();
            } else {
            }
        }
        toastr()->success('Berhasil Disimpan');
        $request->flash();
        return redirect('/datamaster/data/statuspulang');
    }
}
