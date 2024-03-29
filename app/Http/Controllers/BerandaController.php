<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\M_poli;
use GuzzleHttp\Client;
use App\Models\M_pasien;
use App\Models\T_antrian;
use App\Models\T_pelayanan;
use App\Models\T_pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $tgl = Carbon::now()->format('Y-m-d');

        $umum       = T_antrian::where('tanggal', $tgl)->where('kdPoli', '001')->get();
        $gigi       = T_antrian::where('tanggal', $tgl)->where('kdPoli', '002')->get();
        $lansia     = T_antrian::where('tanggal', $tgl)->where('kdPoli', '012')->get();
        $kia        = T_antrian::where('tanggal', $tgl)->where('kdPoli', '003')->get();

        $lab        = T_antrian::where('tanggal', $tgl)->where('kdPoli', '004')->get();
        $hv        = T_antrian::where('tanggal', $tgl)->where('kdPoli', '020')->get();
        $konseling = T_antrian::where('tanggal', $tgl)->where('kdPoli', '021')->get();
        $ko        = T_antrian::where('tanggal', $tgl)->where('kdPoli', '999')->get();
        return view('superadmin.beranda', compact('umum', 'gigi', 'lansia', 'kia', 'lab', 'hv', 'konseling', 'ko'));
    }

    public function panggil($id)
    {
        DB::beginTransaction();
        try {

            T_antrian::find($id)->update([
                'status' => 1,
            ]);

            $d = T_antrian::find($id);

            // simpan ke pendaftaran;
            $n = new T_pendaftaran;
            $n->tglDaftar = Carbon::parse($d->tanggal)->format('d-m-Y');
            $n->kdProviderPeserta = $d->kdProviderPeserta;
            $n->kunjSakit         = $d->kunjSakit;
            $n->kdTkp             = $d->kdTkp;
            $n->noKartu           = $d->noKartu;
            $n->nik               = $d->nik;
            $n->nama              = $d->nama;
            $n->sex               = $d->jenis_kelamin;
            $n->tglLahir          = $d->tanggal_lahir;
            $n->kdPoli            = $d->kdPoli;
            $n->nmPoli            = $d->nmPoli;
            $n->jenis             = $d->jenis;
            $n->save();

            $d->update([
                't_pendaftaran_id' => $n->id,
            ]);
            DB::commit();
            toastr()->success('sukses');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal');
            return back();
        }
    }

    public function periksa($id)
    {
        T_antrian::find($id)->update([
            'status' => 2,
        ]);
        return back();
    }

    public function selesai($id)
    {
        T_antrian::find($id)->update([
            'status' => 3,
        ]);
        return back();
    }

    public function lewati($id)
    {
        T_antrian::find($id)->update([
            'status' => 4,
        ]);
        return back();
    }

    public function antrian()
    {
        return view('superadmin.antrian');
    }

    public function antrianumum()
    {
        $poli = M_poli::get();
        $pasien = M_pasien::get();
        return view('superadmin.antrianumum', compact('poli', 'pasien'));
    }

    public function checknomor()
    {
        $tgl = Carbon::now();
        $nomor = request()->nomor;
        $user = Auth::user();
        try {
            if (Str::length($nomor) == 13) {
                //bpjs
                $response = WSCheckNomor('GET', $nomor);
            } else {
                //nik
                $response = WSCheckNomorByNik('GET', $nomor);
            }
            if ($response == null) {
                request()->flash();
                toastr()->error('Data Tidak Ditemukan');
                return back();
            }

            $poli = M_poli::get();
            $data = $response;

            // if ($data->kdProviderPst->kdProvider != substr($user->user_pcare, 0, 8)) {
            //     toastr()->error('TIDAK BISA MENDAFTAR DI FASKES ' . strtoupper($user->name) . ', ANDA TERDAFTAR DI FASKES ' . $data->kdProviderPst->nmProvider);
            //     request()->flash();
            //     return back();
            // }

            return view('superadmin.antrianbpjs2', compact('data', 'poli', 'tgl'));
        } catch (\Exception $e) {
            $message = json_decode((string)$e->getResponse()->getBody())->response->message;
            toastr()->error($message);
            return back();
        }
    }
    public function storeantrianumum(Request $req)
    {
        DB::beginTransaction();
        try {
            $attr = $req->all();

            $attr['kdPoli'] = M_poli::find($req->poli_id)->kdPoli;
            $attr['nmPoli'] = M_poli::find($req->poli_id)->nmPoli;

            $db = T_antrian::where('tanggal', $req->tanggal)->where('kdPoli', $attr['kdPoli'])->get();
            if ($db->count() == 0) {
                $antrian = antrean(1);
            } else {
                $antrian = antrean((int)$db->last()->nomor_antrian + 1);
            }
            $attr['nomor_antrian'] = $antrian;
            $attr['pendaftaran_id'] = 0;
            $attr['jenis'] = 'UMUM';
            T_antrian::create($attr);
            DB::commit();
            toastr()->success('Pendaftaran Berhasil');
            return redirect('/beranda');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Menyimpan');
            return back();
        }
    }

    public function storeantrianumum2(Request $req)
    {
        DB::beginTransaction();
        try {
            $pasien = M_pasien::find($req->pasien_id);
            $attr = $req->all();
            $attr['nik'] = $pasien->nik;
            $attr['nama'] = $pasien->nama;
            $attr['tanggal_lahir'] = $pasien->tglLahir;
            $attr['jenis_kelamin'] = $pasien->sex;
            $attr['kdPoli'] = M_poli::find($req->poli_id)->kdPoli;
            $attr['nmPoli'] = M_poli::find($req->poli_id)->nmPoli;
            $attr['jenis'] = 'UMUM';

            $db = T_antrian::where('tanggal', $req->tanggal)->where('kdPoli', $attr['kdPoli'])->get();
            if ($db->count() == 0) {
                $antrian = antrean(1);
            } else {
                $antrian = antrean((int)$db->last()->nomor_antrian + 1);
            }
            $attr['nomor_antrian'] = $antrian;
            $attr['pendaftaran_id'] = 0;
            T_antrian::create($attr);
            DB::commit();
            toastr()->success('Pendaftaran Berhasil');
            return redirect('/beranda');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Menyimpan');
            return back();
        }
    }

    public function storeantrianbpjs(Request $req)
    {
        DB::beginTransaction();
        try {
            $attr = $req->all();

            $attr['kdPoli'] = M_poli::find($req->poli_id)->kdPoli;
            $attr['nmPoli'] = M_poli::find($req->poli_id)->nmPoli;

            $check = T_antrian::where('noKartu', $req->noKartu)->where('tanggal', $req->tanggal)->where('kdPoli', $attr['kdPoli'])->first();
            if ($check != null) {
                toastr()->error('Tidak Bisa Mendaftar Pada tanggal Dan Poli Yang sama pada 1 hari');
                return back();
            }

            $db = T_antrian::where('tanggal', $req->tanggal)->where('kdPoli', $attr['kdPoli'])->get();
            if ($db->count() == 0) {
                $antrian = antrean(1);
            } else {
                $antrian = antrean((int)$db->last()->nomor_antrian + 1);
            }
            $attr['nomor_antrian'] = $antrian;
            $attr['pendaftaran_id'] = 0;
            $attr['jenis'] = 'BPJS';

            T_antrian::create($attr);
            DB::commit();
            toastr()->success('Pendaftaran Berhasil');
            return redirect('/beranda');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Menyimpan');
            return back();
        }
    }
    public function antrianbpjs()
    {
        return view('superadmin.antrianbpjs');
    }
    public function statistik()
    {
        $ruangan = M_poli::get()->map(function ($item) {
            return $item->nmPoli;
        });

        $jml = M_poli::get()->map(function ($item) {
            $month = Carbon::today()->format('m');
            $year = Carbon::today()->format('Y');

            //$item->jml = count(T_pelayanan::where('kdPoli', $item->kdPoli)->whereMonth('created_at', $month)->whereYear('created_at', $year)->get());
            $item->jml = rand(5, 20);
            return $item->jml;
        });

        return view('superadmin.statistik', compact('ruangan', 'jml'));
    }
}
