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
        $data = M_pasien::get();
        return view('superadmin.entri.pasien.index', compact('data'));
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
