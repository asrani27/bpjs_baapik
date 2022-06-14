<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showlogin()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                checkBPJS();
                return redirect('/beranda');
            } else {
                return 'role lain';
            }
        } else {
            return view('login');
        }
    }

    public function login(Request $req)
    {
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password], true)) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('/beranda');
            } else {
                return redirect('/kasir');
            }
        } else {
            toastr()->error('Username / Password Tidak Ditemukan');
            $req->flash();
            return back();
        }
    }
}
