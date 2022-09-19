<?php

namespace App\Http\Controllers;

use App\Models\M_sarana;
use Illuminate\Http\Request;

class SaranaController extends Controller
{
    public function index()
    {
        $data = M_sarana::get();
        return view('superadmin.master.sarana.index', compact('data'));
    }
    public function wsGetSarana()
    {
        try {
            $service = WSSarana();

            foreach ($service->list as $i) {

                $check = M_sarana::where('kdSarana', $i->kdSarana)->first();
                if ($check == null) {
                    $n = new M_sarana;
                    $n->kdSarana = $i->kdSarana;
                    $n->nmSarana = $i->nmSarana;
                    $n->save();
                } else {
                }
            }
            toastr()->success('Data Sarana berhasil Di tarik');
            return redirect('/datamaster/data/sarana');
        } catch (\Exception $e) {
            toastr()->error('Coba Lagi');
            return back();
        }
    }
}
