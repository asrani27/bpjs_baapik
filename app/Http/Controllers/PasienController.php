<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\M_pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        try {
            $data = M_pasien::get();
            toastr()->success('Berhasil Dihapus');
            return view('superadmin.entri.pasien.index', compact('data'));
        } catch (\Exception $e) {
            toastr()->error('Gagal Di Hapus');
        }
    }

    public function delete($id)
    {
        M_pasien::find($id)->delete();
        return back();
    }

    public function create()
    {
        return view('superadmin.entri.pasien.create');
    }

    public function store(Request $req)
    {
        $checkNIK = M_pasien::where('nik', $req->nik)->first();
        $checkKartu = M_pasien::where('noKartu', $req->noKartu)->first();
        if ($checkNIK != null) {
            toastr()->error('NIK sudah ada');
            return back();
        }
        if ($checkKartu != null) {
            toastr()->error('no Kartu sudah ada');
            return back();
        }

        M_Pasien::create($req->all());
        toastr()->success('Berhasil Disimpan');
        return redirect('/entri/data/pasien');
    }
    public function sync()
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        try {
            $response = $client->request('GET', 'pendaftaran/tglDaftar/09-06-2022/0/100', [
                'headers' => headers()
            ]);
            $data = json_decode((string)$response->getBody())->response->list;

            foreach ($data as $d) {
                $check = M_pasien::where('kdSadar', $d->kdSadar)->first();
                if ($check == null) {
                    $n = new M_pasien;
                    $n->kdSadar = $d->kdSadar;
                    $n->nmSadar = $d->nmSadar;
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
