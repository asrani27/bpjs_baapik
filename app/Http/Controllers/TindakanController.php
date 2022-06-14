<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\M_tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TindakanController extends Controller
{
    public function index()
    {
        $data = M_tindakan::get();
        return view('superadmin.master.tindakan.index', compact('data'));
    }

    public function sync()
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        try {
            $response = $client->request('GET', 'tindakan/kdTkp/50/0/100', [
                'headers' => headers()
            ]);
            $data = json_decode((string)$response->getBody())->response->list;

            foreach ($data as $d) {
                $check = M_tindakan::where('kdTindakan', $d->kdTindakan)->first();
                if ($check == null) {
                    $n = new M_tindakan;
                    $n->kdTindakan = $d->kdTindakan;
                    $n->nmTindakan = $d->nmTindakan;
                    $n->maxTarif = $d->maxTarif;
                    $n->withValue = $d->withValue;
                    $n->save();
                } else {
                }
            }

            toastr()->success('Berhasil Di Sinkron');
            return back();
        } catch (\Exception $e) {
            dd($e);
            generateHeaders();
            toastr()->error('Gagal Sinkron');
            return back();
        }
    }
}
