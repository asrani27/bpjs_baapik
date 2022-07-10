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
        $data = T_pendaftaran::where('tglDaftar', Carbon::now()->format('d-m-Y'))->get();
        return view('superadmin.entri.pendaftaran.index', compact('data'));
    }

    public function bridgingPendaftaran($id)
    {
        $data = T_pendaftaran::find($id);

        $user = Auth::user();

        $param = json_encode(array(
            'kdProviderPeserta' => $data->kdProviderPeserta,
            'tglDaftar' => $data->tglDaftar,
            'noKartu' => $data->noKartu,
            'kdPoli' => $data->kdPoli,
            'keluhan' => $data->keluhan,
            'kunjSakit' => $data->kunjSakit == 'true' ? true : false,
            'sistole' => $data->sistole == null ? '0' : $data->sistole,
            'diastole' => $data->diastole == null ? '0' : $data->diastole,
            'beratBadan' => $data->beratBadan == null ? '0' : $data->beratBadan,
            'tinggiBadan' => $data->tinggiBadan == null ? '0' : $data->tinggiBadan,
            'respRate' => $data->respRate == null ? '0' : $data->respRate,
            'heartRate' => $data->heartRate == null ? '0' : $data->heartRate,
            'rujukBalik' => $data->rujukBalik == null ? '0' : $data->rujukBalik,
            'kdTkp' => $data->kdTkp,
        ));

        $curl = curl_init();
        //dd(headers());
        curl_setopt_array($curl, array(
            CURLOPT_URL => $user->base_url . "/pendaftaran",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "cache-control: no-cache",
                "content-type: application/json",
                "x-authorization: " . headers()['X-Authorization'],
                "x-cons-id: " . headers()['X-cons-id'],
                "x-signature: " . headers()['X-Signature'],
                "x-timestamp: " . headers()['X-Timestamp']
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            toastr()->error($err);
            return back();
        } else {
            $data->update([
                'noUrut' => json_decode($response)->response->message,
            ]);
            toastr()->success('Sukses Bridging');
            return back();
        }
        try {
        } catch (\Exception $e) {
            toastr()->error('Gagal Bridging, BPJS Sedang Gangguan..');
            return back();
        }
    }

    public function delete($id)
    {
        $data = T_pendaftaran::find($id);
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        try {
            $response = $client->request('DELETE', 'pendaftaran/peserta/' . $data->noKartu . '/tglDaftar/' . $data->tglDaftar . '/noUrut/' . $data->noUrut . '/kdPoli/' . $data->kdPoli, [
                'headers' => headers()
            ]);
            $data->delete();
            toastr()->success('Sukses Di hapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Gagal, BPJS Gangguan');
            return back();
        }
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
                            $n->status = $d->status;
                            $n->kunjSakit = $d->kunjSakit;
                            $n->kdTkp = $d->tkp->kdTkp;
                            $n->nmTkp = $d->tkp->nmTkp;
                            $n->save();
                        } else {
                            $u = $check;
                            $u->status = $d->status;
                            $u->kunjSakit = $d->kunjSakit;
                            $u->kdTkp = $d->tkp->kdTkp;
                            $u->nmTkp = $d->tkp->nmTkp;
                            $u->save();
                        }
                    }
                    $req->flash();
                    toastr()->success('Sukses Di Tarik');

                    $data = T_pendaftaran::where('tglDaftar', Carbon::parse($req->tanggal)->format('d-m-Y'))->get();
                    $req->flash();
                    return view('superadmin.entri.pendaftaran.index', compact('data'));
                }
            } catch (\Exception $e) {
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
