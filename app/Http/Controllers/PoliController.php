<?php

namespace App\Http\Controllers;

use App\Models\M_poli;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function index()
    {
        $data = M_poli::get();
        return view('superadmin.master.poli.index', compact('data'));
    }

    public function create()
    {
        $data = null;
        return view('superadmin.master.poli.create', compact('data'));
    }

    public function wsGetPoli(Request $request)
    {

        $service = WSPoli('GET', 0, 100);

        if ($service == null) {
            toastr()->error('Data Tidak Ditemukan');
            $request->flash();
            return back();
        } else {
            $data = $service;
            $request->flash();
            toastr()->success('Data Ditemukan');

            return view('superadmin.master.poli.create', compact('data'));
        }
    }
    public function store(Request $request)
    {
        $data = json_decode($request->jsonDiag);
        foreach ($data as $i) {
            $check = M_poli::where('kdPoli', $i->kdPoli)->first();
            if ($check == null) {
                $n = new M_poli;
                $n->kdPoli = $i->kdPoli;
                $n->nmPoli = $i->nmPoli;
                $n->poliSakit = $i->nmPoli == false ? 0 : 1;
                $n->save();
            } else {
            }
        }
        toastr()->success('Berhasil Disimpan');
        $request->flash();
        return redirect('/datamaster/data/poli');
    }
    public function edit($id)
    {
        $data = M_poli::find($id);
        return view('superadmin.master.poli.edit', compact('data'));
    }

    public function delete($id)
    {
        $data = M_poli::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();

        M_poli::find($id)->update($attr);

        toastr()->success('Berhasil Di Update');
        return redirect('/datamaster/data/poli');
    }

    public function sync()
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        try {

            $response = $client->request('GET', 'poli/fktp/0/100', [
                'headers' => headers()
            ]);

            $data = json_decode((string)$response->getBody())->response->list;
            foreach ($data as $d) {

                $check = M_poli::where('kdpoli', $d->kdPoli)->first();
                if ($check == null) {
                    $n = new M_poli;
                    $n->kdPoli = $d->kdPoli;
                    $n->nmPoli = $d->nmPoli;
                    $n->poliSakit = $d->poliSakit;
                    $n->save();
                } else {
                }
            }

            toastr()->success('Berhasil Di Sinkron');
            return back();
        } catch (\Exception $e) {

            generateHeaders();
            toastr()->error('Gagal Sinkron');
            return back();
        }
    }
}
