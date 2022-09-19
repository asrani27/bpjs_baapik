<?php

namespace App\Http\Controllers;

use App\Models\T_pelayanan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function kunjungan($id)
    {
        $data = T_pelayanan::find($id);

        $resp = WSGetKunjungan('GET', $data->noKartu);
        dd($resp);
    }
}
