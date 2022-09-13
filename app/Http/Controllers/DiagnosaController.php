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
            return view('superadmin.master.diagnosa.add', compact('data'));
        }
    }

    public function sync()
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        try {
            $response = $client->request('GET', 'diagnosa/a/0/90000', [
                'headers' => headers()
            ]);
            $data = json_decode((string)$response->getBody())->response->list;

            foreach ($data as $d) {
                $check = M_diagnosa::where('kdDiag', $d->kdDiag)->first();
                if ($check == null) {
                    $n = new M_diagnosa;
                    $n->kdDiag = $d->kdDiag;
                    $n->nmDiag = $d->nmDiag;
                    $n->nonSpesialis = $d->nonSpesialis;
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
