<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function bpjs()
    {
        $data = Auth::user();
        return view('superadmin.bpjs.index', compact('data'));
    }

    public function testapi()
    {
        //dd('dasd');
        dd(env('APP_ENV'));
    }

    public function gantipass()
    {
        return view('superadmin.bpjs.gantipass');
    }

    public function updatepass(Request $req)
    {
        if ($req->pass1 != $req->pass2) {
            toastr()->error('Password Tidak Sama');
            return back();
        }

        Auth::user()->update([
            'password' => bcrypt($req->pass1)
        ]);

        Auth::logout();

        toastr()->success('Login Dengan Password Baru');
        return redirect('/');
    }

    public function updatebpjs(Request $req)
    {
        $u = Auth::user();
        $u->cons_id = $req->cons_id;
        $u->secret_key = $req->secret_key;
        $u->user_pcare = $req->user_pcare;
        $u->pass_pcare = $req->pass_pcare;
        $u->base_url   = $req->base_url;
        $u->save();
        toastr()->success('Berhasil Di Update');
        return back();
    }

    public function connectBPJS()
    {
        $user = Auth::user();

        // if ($user->cons_id == null) {
        //     toastr()->error('CONS ID KOSONG');
        //     return back();
        // }
        // if ($user->secret_key == null) {
        //     toastr()->error('SECRET KEY KOSONG');
        //     return back();
        // }
        if ($user->user_pcare == null) {
            toastr()->error('USER PCARE KOSONG');
            return back();
        }
        if ($user->pass_pcare == null) {
            toastr()->error('PASS PCARE KOSONG');
            return back();
        }

        $client = new Client([
            'base_uri' => $user->base_url,
        ]);

        // dd($response->getStatusCode());
        // $data = json_decode((string)$response->getBody());
        // dd($data);
        try {
            $response = $client->request('GET', 'dokter/0/10', [
                'headers' => headers()
            ]);
            Auth::user()->update(['is_connect' => 1]);
            toastr()->success('KONNEK');
            return back();
        } catch (\Exception $e) {

            toastr()->error('GAGAL CONNECT, WEBSERVICE BPJS SEDANG GANGGUAN');

            Auth::user()->update(['is_connect' => 0]);
            $this->generateHeaders();
            return back();
        }
    }

    public function generateHeaders()
    {
        $user = Auth::user();

        $cons_id = $user->cons_id;
        $secret_key = $user->secret_key;
        $username_pcare = $user->user_pcare;
        $password_pcare = $user->pass_pcare;
        $kdAplikasi = '095';

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $cons_id . "&" . $tStamp, $secret_key, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);

        $Authorization = base64_encode($username_pcare . ':' . $password_pcare . ':' . $kdAplikasi);

        $head['X-cons-id'] = $cons_id;
        $head['X-Timestamp'] = $tStamp;
        $head['X-Signature'] = $encodedSignature;
        $head['X-Authorization'] = $Authorization;

        $u = Auth::user();
        $u->x_timestamp = $head['X-Timestamp'];
        $u->x_signature = $head['X-Signature'];
        $u->x_authorization = 'Basic ' . $head['X-Authorization'];
        $u->save();
    }

    public function headers()
    {
        $user = Auth::user();
        $headers = [
            'accept'            => 'application/json',
            'X-Cons-id'         => $user->cons_id,
            'X-Timestamp'       => $user->x_timestamp,
            'X-Signature'       => $user->x_signature,
            'X-Authorization'   => $user->x_authorization,
        ];
        return $headers;
    }
}
