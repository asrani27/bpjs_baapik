<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\T_pendaftaran;
use Illuminate\Support\Facades\DB;
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
        if (Auth::user()->mode == 0) {
            $param = json_encode(array(
                'kdProviderPeserta' => $data->kdProviderPeserta,
                'tglDaftar' => $data->tglDaftar,
                'noKartu' => $data->noKartu,
                'kdPoli' => $data->kdPoli,
                'keluhan' => $data->keluhan,
                'kunjSakit' => $data->kunjSakit == 'true' ? true : false,
                'sistole' => $data->sistole == null ? 0 : $data->sistole,
                'diastole' => $data->diastole == null ? 0 : $data->diastole,
                'beratBadan' => $data->beratBadan == null ? 0 : $data->beratBadan,
                'tinggiBadan' => $data->tinggiBadan == null ? 0 : $data->tinggiBadan,
                'respRate' => $data->respRate == null ? 0 : $data->respRate,
                'lingkarPerut' => $data->lingkarPerut == null ? 0 : $data->lingkarPerut,
                'heartRate' => $data->heartRate == null ? 0 : $data->heartRate,
                'rujukBalik' => $data->rujukBalik == null ? 0 : $data->rujukBalik,
                'kdTkp' => $data->kdTkp,
            ));
        } else {
            $param = json_encode(array(
                'kdProviderPeserta' => $data->kdProviderPeserta,
                'tglDaftar' => $data->tglDaftar,
                'noKartu' => $data->noKartu,
                'kdPoli' => $data->kdPoli,
                'keluhan' => $data->keluhan,
                'kunjSakit' => $data->kunjSakit == 'true' ? true : false,
                'sistole' => $data->sistole == null ? 0 : $data->sistole,
                'diastole' => $data->diastole == null ? 0 : $data->diastole,
                'beratBadan' => $data->beratBadan == null ? 0 : $data->beratBadan,
                'tinggiBadan' => $data->tinggiBadan == null ? 0 : $data->tinggiBadan,
                'respRate' => $data->respRate == null ? 0 : $data->respRate,
                'heartRate' => $data->heartRate == null ? 0 : $data->heartRate,
                'rujukBalik' => $data->rujukBalik == null ? 0 : $data->rujukBalik,
                'kdTkp' => $data->kdTkp,
            ));
        }

        DB::beginTransaction();

        try {
            $response = WSPostPendaftaran('POST', $param);
            //dd($response->message);
            T_pendaftaran::find($id)->update([
                'noUrut' => $response->message,
            ]);

            DB::commit();
            toastr()->success('Sukses Bridging');
            return back();
        } catch (\Exception $e) {

            DB::rollback();
            toastr()->error('Gagal');
            return back();
        }


        // if ($err) {
        //     toastr()->error($err);
        //     return back();
        // } else {
        //     $data->update([
        //         'noUrut' => json_decode($response)->response->message,
        //     ]);
        //     toastr()->success('Sukses Bridging');
        //     return back();
        // }

    }

    public function delete($id)
    {
        $data = T_pendaftaran::find($id);

        try {
            WSDeletePendaftaran('delete', $data->noKartu, $data->tglDaftar, $data->noUrut, $data->kdPoli);
            $data->delete();
            toastr()->success('Sukses Di hapus');
            return back();
        } catch (\Exception $e) {
            dd($e);
            toastr()->error('Gagal');
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
                $dataresp = WSGetPendaftaran('GET', Carbon::parse($req->tanggal)->format('d-m-Y'), 0, 1000);

                if ($dataresp == null) {
                    toastr()->info('TIDAK ADA DATA');
                    $req->flash();
                    $data = T_pendaftaran::where('tglDaftar', Carbon::parse($req->tanggal)->format('d-m-Y'))->get();
                    return view('superadmin.entri.pendaftaran.index', compact('data'));
                } else {
                    foreach ($dataresp->list as $d) {
                        $checkExist = T_pendaftaran::where('noKartu', $d->peserta->noKartu)->where('tglDaftar', $d->tglDaftar)->where('kdPoli', $d->poli->kdPoli)->first();

                        if ($checkExist == null) {
                            $check = T_pendaftaran::where('noUrut', $d->noUrut)->where('tglDaftar', $d->tglDaftar)->first();
                            if ($check == null) {
                                $n = new T_pendaftaran;
                                $n->noUrut = $d->noUrut;
                                $n->tglDaftar = $d->tglDaftar;
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
                        } else {
                            $u = $checkExist;
                            $u->noUrut = $d->noUrut;
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

                $message = json_decode((string)$e->getResponse()->getBody())->metaData->message;
                $req->flash();
                toastr()->error($message);
                return back();
            }
        } else {
            $data = T_pendaftaran::where('tglDaftar', Carbon::parse($req->tanggal)->format('d-m-Y'))->get();
            $req->flash();
            return view('superadmin.entri.pendaftaran.index', compact('data'));
        }
    }
}
