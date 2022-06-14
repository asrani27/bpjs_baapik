<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\M_kesadaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KesadaranController extends Controller
{
    public function index()
    {
        $data = M_kesadaran::get();
        return view('superadmin.master.kesadaran.index', compact('data'));
    }

    public function sync()
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        try {
            $response = $client->request('GET', 'kesadaran', [
                'headers' => headers()
            ]);
            $data = json_decode((string)$response->getBody())->response->list;

            foreach ($data as $d) {
                $check = M_kesadaran::where('kdSadar', $d->kdSadar)->first();
                if ($check == null) {
                    $n = new M_kesadaran;
                    $n->kdSadar = $d->kdSadar;
                    $n->nmSadar = $d->nmSadar;
                    $n->save();
                } else {
                }
            }

            toastr()->success('Berhasil Di Sinkron');
            return back();
        } catch (\Exception $e) {

            generateHeaders();
            toastr()->error('Gagal Sinkron');
            return back();
        }
    }
}
