<?php

namespace App\Http\Controllers;

use App\Models\M_diagnosa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\M_dokter;
use App\Models\T_anamnesa;
use App\Models\M_kesadaran;
use App\Models\M_status_pulang;
use App\Models\M_tindakan;
use App\Models\T_diagnosa;
use App\Models\T_pelayanan;
use App\Models\T_tindakan;

class PelayananController extends Controller
{
    public function index()
    {
        $data = T_pelayanan::orderBy('id', 'DESC')->get();
        return view('superadmin.entri.pelayanan.index', compact('data'));
    }

    public function anamnesa($id)
    {
        $data = T_pelayanan::find($id);
        $dokter = M_dokter::get();
        $kesadaran = M_kesadaran::get();
        $statuspulang = M_status_pulang::get();
        if ($data->anamnesa == null) {
            return view('superadmin.entri.pelayanan.anamnesa', compact('data', 'dokter', 'kesadaran', 'statuspulang'));
        } else {
            $anamnesa = $data->anamnesa;
            return view('superadmin.entri.pelayanan.anamnesa2', compact('data', 'dokter', 'kesadaran', 'statuspulang', 'anamnesa'));
        }
    }

    public function diagnosa($id)
    {
        $data = T_pelayanan::find($id);
        $diagnosa = M_diagnosa::get();

        $myDiag = $data->diagnosa;

        return view('superadmin.entri.pelayanan.diagnosa', compact('data', 'diagnosa', 'myDiag'));
    }

    public function resep($id)
    {
        toastr()->info('Dalam Pengembangan');
        return back();
    }

    public function tindakan($id)
    {
        $data = T_pelayanan::find($id);
        $tindakan = M_tindakan::get();

        $myTindakan = $data->tindakan;

        return view('superadmin.entri.pelayanan.tindakan', compact('data', 'tindakan', 'myTindakan'));
    }


    public function storeAnamnesa(Request $req, $id)
    {
        $attr = $req->all();
        $attr['tanggalPulang'] = Carbon::now();

        T_anamnesa::create($attr);

        toastr()->success('Anamnesa Berhasil DiSimpan');
        return redirect('/entri/data/pelayanan');
    }


    public function updateAnamnesa(Request $req, $id)
    {
        $attr = $req->all();
        $attr['tanggalPulang'] = Carbon::now();

        T_pelayanan::find($id)->anamnesa->update($attr);

        toastr()->success('Anamnesa Berhasil Diupdate');
        return redirect('/entri/data/pelayanan');
    }

    public function storeDiagnosa(Request $req, $id)
    {
        $attr = $req->all();

        T_diagnosa::create($attr);

        toastr()->success('Diagnosa Berhasil DiSimpan');
        return back();
    }

    public function storeResep(Request $req, $id)
    {
    }

    public function storeTindakan(Request $req, $id)
    {

        $attr = $req->all();

        T_tindakan::create($attr);

        toastr()->success('Tindakan Berhasil DiSimpan');
        return back();
    }

    public function deleteDiagnosa($id)
    {
        T_diagnosa::find($id)->delete();
        toastr()->success('Berhasil Dihapus');
        return back();
    }

    public function deleteTindakan($id)
    {
        T_tindakan::find($id)->delete();
        toastr()->success('Berhasil Dihapus');
        return back();
    }
}
