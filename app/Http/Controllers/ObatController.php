<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_obat;

class ObatController extends Controller
{
    public function index()
    {
        $data = M_obat::orderBy('id', 'DESC')->get();
        return view('superadmin.master.obat.index', compact('data'));
    }
    public function create()
    {
        return view('superadmin.master.obat.create');
    }

    public function store(Request $req)
    {
        $attr = $req->all();

        M_obat::create($attr);

        toastr()->success('Berhasil Di Simpan');
        return redirect('/datamaster/data/obat');
    }

    public function edit($id)
    {
        $data = M_obat::find($id);
        return view('superadmin.master.obat.edit', compact('data'));
    }

    public function delete($id)
    {
        $data = M_obat::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();

        M_obat::find($id)->update($attr);

        toastr()->success('Berhasil Di Update');
        return redirect('/datamaster/data/obat');
    }
}
