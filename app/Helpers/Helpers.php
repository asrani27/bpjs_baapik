<?php

use App\Models\Barang;
use App\Models\Satuan;
use GuzzleHttp\Client;
use App\Models\BarangToko;
use Illuminate\Support\Facades\Auth;

function convertBulan($bulan)
{
    if ($bulan == '01') {
        $hasil = 'Januari';
    } elseif ($bulan == '02') {
        $hasil = 'Februari';
    } elseif ($bulan == '03') {
        $hasil = 'Maret';
    } elseif ($bulan == '04') {
        $hasil = 'April';
    } elseif ($bulan == '05') {
        $hasil = 'Mei';
    } elseif ($bulan == '06') {
        $hasil = 'Juni';
    } elseif ($bulan == '07') {
        $hasil = 'Juli';
    } elseif ($bulan == '08') {
        $hasil = 'Agustus';
    } elseif ($bulan == '09') {
        $hasil = 'September';
    } elseif ($bulan == '10') {
        $hasil = 'Oktober';
    } elseif ($bulan == '11') {
        $hasil = 'November';
    } elseif ($bulan == '12') {
        $hasil = 'Desember';
    }
    return $hasil;
}

function checkBPJS()
{
    $user = Auth::user();

    $client = new Client([
        'base_uri' => $user->base_url,
    ]);
    $headers = [
        'X-Cons-id'         => $user->cons_id,
        'X-Timestamp'       => $user->x_timestamp,
        'X-Signature'       => $user->x_signature,
        'X-Authorization'   => $user->x_authorization,
    ];
    try {
        $response = $client->request('GET', 'dokter/0/100', [
            'headers' => $headers
        ]);
        Auth::user()->update(['is_connect' => 1]);
    } catch (\Exception $e) {
        Auth::user()->update(['is_connect' => 0]);
        generateHeaders();
    }
}

function headers()
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
    $head['X-Authorization'] = 'Basic ' . $Authorization;

    return $head;
}

function generateHeaders()
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

function antrean($param)
{
    if (strlen($param) == 1) {
        return $hasil = '000' . $param;
    } elseif (strlen($param) == 2) {
        return $hasil = '00' . $param;
    } elseif (strlen($param) == 3) {
        return $hasil = '0' . $param;
    }
}
