<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\M_dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index()
    {
        $data = M_dokter::get();
        return view('superadmin.master.dokter.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.master.dokter.create');
    }

    public function store(Request $req)
    {
        $attr = $req->all();

        M_dokter::create($attr);

        toastr()->success('Berhasil Di Simpan');
        return redirect('/datamaster/data/dokter');
    }

    public function edit($id)
    {
        $data = M_dokter::find($id);
        return view('superadmin.master.dokter.edit', compact('data'));
    }

    public function delete($id)
    {
        $data = M_dokter::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();

        M_dokter::find($id)->update($attr);

        toastr()->success('Berhasil Di Update');
        return redirect('/datamaster/data/dokter');
    }

    public function sync()
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        try {
            $response = $client->request('GET', 'dokter/0/100', [
                'headers' => headers()
            ]);
            $data = json_decode((string)$response->getBody())->response->list;
            foreach ($data as $d) {

                $check = M_dokter::where('kdDokter', $d->kdDokter)->first();
                if ($check == null) {
                    $n = new M_dokter;
                    $n->kdDokter = $d->kdDokter;
                    $n->nmDokter = $d->nmDokter;
                    $n->is_bridging = 1;
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
