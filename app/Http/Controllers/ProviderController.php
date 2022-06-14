<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\M_provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function index()
    {
        $data = M_provider::get();
        return view('superadmin.master.provider.index', compact('data'));
    }

    public function sync()
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        try {
            $response = $client->request('GET', 'provider/0/100', [
                'headers' => headers()
            ]);
            $data = json_decode((string)$response->getBody())->response->list;

            foreach ($data as $d) {
                $check = M_provider::where('kdProvider', $d->kdProvider)->first();
                if ($check == null) {
                    $n = new M_provider;
                    $n->kdProvider = $d->kdProvider;
                    $n->nmProvider = $d->nmProvider; 
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
