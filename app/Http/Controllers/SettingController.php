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
        $u->user_key   = $req->user_key;
        $u->mode   = $req->mode;
        $u->cons_id_dev = $req->cons_id_dev;
        $u->secret_key_dev = $req->secret_key_dev;
        $u->user_pcare_dev = $req->user_pcare_dev;
        $u->pass_pcare_dev = $req->pass_pcare_dev;
        $u->save();

        Auth::user()->update(['is_connect' => 0]);

        toastr()->success('Berhasil Di Update, Lanjutkan test connection');
        return back();
    }

    public function connectBPJS()
    {
        $user = Auth::user();

        if ($user->cons_id == null) {
            toastr()->error('CONS ID KOSONG');
            return back();
        }
        if ($user->secret_key == null) {
            toastr()->error('SECRET KEY KOSONG');
            return back();
        }
        if ($user->user_pcare == null) {
            toastr()->error('USER PCARE KOSONG');
            return back();
        }
        if ($user->pass_pcare == null) {
            toastr()->error('PASS PCARE KOSONG');
            return back();
        }

        try {
            $data = WSDiagnosa('GET', '0', 0, 10);

            Auth::user()->update(['is_connect' => 1]);
            toastr()->success('KONNEK');
            return back();
        } catch (\Exception $e) {

            toastr()->error('GAGAL CONNECT');

            Auth::user()->update(['is_connect' => 0]);

            return back();
        }
    }
}
