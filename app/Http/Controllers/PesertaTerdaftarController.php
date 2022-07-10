<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesertaTerdaftarController extends Controller
{
    public function index()
    {
        toastr()->error('Dalam Pengembangan');
        return back();
    }
}
