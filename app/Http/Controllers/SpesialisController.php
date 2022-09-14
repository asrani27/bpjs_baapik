<?php

namespace App\Http\Controllers;

use App\Models\M_spesialis;
use App\Models\M_sub_spesialis;
use Illuminate\Http\Request;

class SpesialisController extends Controller
{
    public function index()
    {
        $data = M_spesialis::get();
        return view('superadmin.master.spesialis.index', compact('data'));
    }
    public function wsGetSpesialis()
    {
        try {
            $service = WSSpesialis();

            foreach ($service->list as $i) {

                $check = M_spesialis::where('kdSpesialis', $i->kdSpesialis)->first();
                if ($check == null) {
                    $n = new M_spesialis;
                    $n->kdSpesialis = $i->kdSpesialis;
                    $n->nmSpesialis = $i->nmSpesialis;
                    $n->save();
                } else {
                }
            }
            toastr()->success('Data Spesialis berhasil Di tarik');
            return redirect('/datamaster/data/spesialis');
        } catch (\Exception $e) {
            toastr()->error('Coba Lagi');
            return back();
        }
    }

    public function wsGetSubSpesialis($kode)
    {
        try {
            $service = WSSubSpesialis('GET', $kode);
            foreach ($service->list as $i) {

                $check = M_sub_spesialis::where('kdSubSpesialis', $i->kdSubSpesialis)->first();
                if ($check == null) {
                    $n = new M_sub_spesialis;
                    $n->kdSubSpesialis = $i->kdSubSpesialis;
                    $n->nmSubSpesialis = $i->nmSubSpesialis;
                    $n->kdPoliRujuk = $i->kdPoliRujuk;
                    $n->spesialis_id = M_spesialis::where('kdSpesialis', $kode)->first()->id;
                    $n->save();
                } else {
                }
            }
            toastr()->success('Data Sub Spesialis berhasil Di tarik');
            return redirect('/datamaster/data/spesialis');
        } catch (\Exception $e) {

            toastr()->error('Coba Lagi');
            return back();
        }
    }
}
