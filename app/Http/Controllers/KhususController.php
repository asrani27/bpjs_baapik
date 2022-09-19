<?php

namespace App\Http\Controllers;

use App\Models\M_khusus;
use Illuminate\Http\Request;

class KhususController extends Controller
{
    public function index()
    {
        $data = M_khusus::get();
        return view('superadmin.master.khusus.index', compact('data'));
    }
    public function wsGetKhusus()
    {
        try {

            $service = WSKhusus('GET');

            foreach ($service->list as $i) {

                $check = M_khusus::where('kdKhusus', $i->kdKhusus)->first();
                if ($check == null) {
                    $n = new M_khusus;
                    $n->kdKhusus = $i->kdKhusus;
                    $n->nmKhusus = $i->nmKhusus;
                    $n->save();
                } else {
                }
            }
            toastr()->success('Data Khusus berhasil Di tarik');
            return redirect('/datamaster/data/khusus');
        } catch (\Exception $e) {
            toastr()->error('Coba Lagi');
            return back();
        }
    }
}
