<?php

use App\Models\Barang;
use App\Models\Satuan;
use GuzzleHttp\Client;
use App\Models\BarangToko;
use Illuminate\Support\Facades\Auth;

function hitungUmur($umur)
{
    $lahir = new DateTime($umur);
    $today = new DateTime('today');
    $y = $today->diff($lahir)->y;
    $m = $today->diff($lahir)->m;
    $d = $today->diff($lahir)->d;
    $umur = $y . " Tahun " . $m . " Bulan " . $d . " Hari";
    return $umur;
}
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

    $head['accept']    = 'application/json';
    $head['Content-Type']    = 'application/json';
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



function headerDevelopment()
{
    $user = Auth::user();

    $cons_id = $user->cons_id_dev;
    $secret_key = $user->secret_key_dev;
    $username_pcare = $user->user_pcare_dev;
    $password_pcare = $user->pass_pcare_dev;
    $user_key = $user->user_key;
    $kdAplikasi = '095';

    date_default_timezone_set('UTC');
    $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
    $signature = hash_hmac('sha256', $cons_id . "&" . $tStamp, $secret_key, true);
    $encodedSignature = base64_encode($signature);

    $Authorization = base64_encode($username_pcare . ':' . $password_pcare . ':' . $kdAplikasi);

    $head['Content-Type']    = 'application/json';
    $head['X-cons-id'] = $cons_id;
    $head['X-Timestamp'] = $tStamp;
    $head['X-Signature'] = $encodedSignature;
    $head['X-Authorization'] = 'Basic ' . $Authorization;
    $head['user_key'] = $user_key;

    return $head;
}

function headerProduction()
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

    $Authorization = base64_encode($username_pcare . ':' . $password_pcare . ':' . $kdAplikasi);

    $head['accept']    = 'application/json';
    $head['Content-Type']    = 'application/json';
    $head['X-cons-id'] = $cons_id;
    $head['X-Timestamp'] = $tStamp;
    $head['X-Signature'] = $encodedSignature;
    $head['X-Authorization'] = 'Basic ' . $Authorization;

    return $head;
}

function urlDevelopment()
{
    return new Client([
        'base_uri' => 'https://apijkn-dev.bpjs-kesehatan.go.id/pcare-rest-dev/',
    ]);
}

function urlProduction()
{
    return new Client([
        'base_uri' => 'https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0/',
    ]);
}

function decryptString($string)
{
    $key = headerDevelopment()['X-cons-id'] . Auth::user()->secret_key_dev . headerDevelopment()['X-Timestamp'];

    $encrypt_method = 'AES-256-CBC';
    $key_hash = hex2bin(hash('sha256', $key));
    $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

    $result = json_decode(\LZCompressor\LZString::decompressFromEncodedURIComponent($output));

    return $result;
}


// SERVICE BPJS 
function WSDiagnosa($type = 'GET', $kode = '0', $row = 0, $limit = 10000)
{
    $mode = Auth::user()->mode;

    if ($mode == 0) {
        $client = urlDevelopment();

        $response = $client->request($type, 'diagnosa/' . $kode . '/' . $row . '/' . $limit, [
            'headers' => headerDevelopment(),
        ]);
        $string = json_decode((string)$response->getBody())->response;

        return decryptString($string);
    } else {
        $client = urlProduction();
        $response = $client->request($type, 'diagnosa/' . $kode . '/' . $row . '/' . $limit, [
            'headers' => headerProduction(),
        ]);
        $data = json_decode((string)$response->getBody())->response;
        return $data;
    }
}

function WSDokter($type = 'GET', $param1 = 0, $param2 = 1000)
{
    $mode = Auth::user()->mode;

    if ($mode == 0) {
        $client = urlDevelopment();

        $response = $client->request($type, 'dokter/'  . $param1 . '/' . $param2, [
            'headers' => headerDevelopment(),
        ]);
        $string = json_decode((string)$response->getBody())->response;

        return decryptString($string);
    } else {
        $client = urlProduction();
        $response = $client->request($type, 'dokter/' . '/' . $param1 . '/' . $param2, [
            'headers' => headerProduction(),
        ]);
        $data = json_decode((string)$response->getBody())->response;
        return $data;
    }
}

function WSKesadaran($type = 'GET')
{
    $mode = Auth::user()->mode;

    if ($mode == 0) {
        $client = urlDevelopment();

        $response = $client->request($type, 'kesadaran', [
            'headers' => headerDevelopment(),
        ]);
        $string = json_decode((string)$response->getBody())->response;

        return decryptString($string);
    } else {
        $client = urlProduction();
        $response = $client->request($type, 'kesadaran', [
            'headers' => headerProduction(),
        ]);
        $data = json_decode((string)$response->getBody())->response;
        return $data;
    }
}

function WSPoli($type = 'GET', $param1 = 0, $param2 = 1000)
{
    $mode = Auth::user()->mode;

    if ($mode == 0) {
        $client = urlDevelopment();

        $response = $client->request($type, 'poli/fktp/' . '/' . $param1 . '/' . $param2, [
            'headers' => headerDevelopment(),
        ]);
        $string = json_decode((string)$response->getBody())->response;

        return decryptString($string);
    } else {
        $client = urlProduction();
        $response = $client->request($type, 'poli/fktp/' . '/' . $param1 . '/' . $param2, [
            'headers' => headerProduction(),
        ]);
        $data = json_decode((string)$response->getBody())->response;
        return $data;
    }
}

function WSProvider($type = 'GET', $param1 = 0, $param2 = 1000)
{
    $mode = Auth::user()->mode;

    if ($mode == 0) {
        $client = urlDevelopment();

        $response = $client->request($type, 'provider/' . $param1 . '/' . $param2, [
            'headers' => headerDevelopment(),
        ]);
        $string = json_decode((string)$response->getBody())->response;

        return decryptString($string);
    } else {
        $client = urlProduction();
        $response = $client->request($type, 'provider/' . $param1 . '/' . $param2, [
            'headers' => headerProduction(),
        ]);
        $data = json_decode((string)$response->getBody())->response;
        return $data;
    }
}

function WSStatusPulang($type = 'GET', $param1 = true)
{
    $mode = Auth::user()->mode;

    if ($mode == 0) {
        $client = urlDevelopment();

        $response = $client->request($type, 'statuspulang/rawatInap/' . $param1, [
            'headers' => headerDevelopment(),
        ]);
        $string = json_decode((string)$response->getBody())->response;

        return decryptString($string);
    } else {
        $client = urlProduction();
        $response = $client->request($type, 'statuspulang/rawatInap/' . $param1, [
            'headers' => headerProduction(),
        ]);
        $data = json_decode((string)$response->getBody())->response;
        return $data;
    }
}

function WSSpesialis($type = 'GET')
{
    $mode = Auth::user()->mode;

    if ($mode == 0) {
        $client = urlDevelopment();

        $response = $client->request($type, 'spesialis', [
            'headers' => headerDevelopment(),
        ]);
        $string = json_decode((string)$response->getBody())->response;

        return decryptString($string);
    } else {
        $client = urlProduction();
        $response = $client->request($type, 'spesialis', [
            'headers' => headerProduction(),
        ]);
        $data = json_decode((string)$response->getBody())->response;
        return $data;
    }
}

function WSSubSpesialis($type = 'GET', $param1 = null)
{
    $mode = Auth::user()->mode;

    if ($mode == 0) {
        $client = urlDevelopment();

        $response = $client->request($type, 'spesialis/' . $param1 . '/subspesialis', [
            'headers' => headerDevelopment(),
        ]);
        $string = json_decode((string)$response->getBody())->response;

        return decryptString($string);
    } else {
        $client = urlProduction();
        $response = $client->request($type, 'spesialis/' . $param1 . '/subspesialis',  [
            'headers' => headerProduction(),
        ]);
        $data = json_decode((string)$response->getBody())->response;
        return $data;
    }
}
