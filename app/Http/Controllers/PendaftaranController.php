<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\T_pendaftaran;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index()
    {
        $data = [];
        return view('superadmin.entri.pendaftaran.index', compact('data'));
    }
    public function sync(Request $req)
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);


        if ($req->button == 'tarik') {
            try {
                $response = $client->request('GET', 'pendaftaran/tglDaftar/' . Carbon::parse($req->tanggal)->format('d-m-Y') . '/0/100', [
                    'headers' => headers()
                ]);
                $dataresp = json_decode((string)$response->getBody())->response;

                if ($dataresp == null) {
                    toastr()->success('TIDAK ADA DATA');
                    $req->flash();
                    $data = T_pendaftaran::where('tglDaftar', Carbon::parse($req->tanggal)->format('d-m-Y'))->get();
                    return view('superadmin.entri.pendaftaran.index', compact('data'));
                } else {
                    foreach ($dataresp->list as $d) {
                        $check = T_pendaftaran::where('noUrut', $d->noUrut)->where('tglDaftar', $d->tgldaftar)->first();
                        if ($check == null) {
                            $n = new T_pendaftaran;
                            $n->noUrut = $d->noUrut;
                            $n->tglDaftar = $d->tgldaftar;
                            $n->noKartu = $d->peserta->noKartu;
                            $n->nama = $d->peserta->nama;
                            $n->sex = $d->peserta->sex;
                            $n->tglLahir = $d->peserta->tglLahir;
                            $n->kdPoli = $d->poli->kdPoli;
                            $n->nmPoli = $d->poli->nmPoli;
                            $n->save();
                        } else {
                        }
                    }
                    $req->flash();
                    toastr()->success('Sukses Di Tarik');

                    $data = T_pendaftaran::where('tglDaftar', Carbon::parse($req->tanggal)->format('d-m-Y'))->get();
                    $req->flash();
                    return view('superadmin.entri.pendaftaran.index', compact('data'));
                }
            } catch (\Exception $e) {

                generateHeaders();
                $req->flash();
                toastr()->error('Gagal Sinkron');
                return back();
            }
        } else {
            $data = T_pendaftaran::where('tglDaftar', Carbon::parse($req->tanggal)->format('d-m-Y'))->get();
            $req->flash();
            return view('superadmin.entri.pendaftaran.index', compact('data'));
        }
    }
}
