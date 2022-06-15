<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\KesadaranController;
use App\Http\Controllers\PendaftaranController;

Route::get('/', [LoginController::class, 'showlogin']);
Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('/beranda', [BerandaController::class, 'index']);
    Route::get('/logout', [LogoutController::class, 'logout']);
    Route::get('/setting/data/bpjs', [SettingController::class, 'bpjs']);
    Route::post('/setting/data/bpjs', [SettingController::class, 'updatebpjs']);
    Route::get('/setting/data/bpjs/connect', [SettingController::class, 'connectBPJS']);

    Route::get('/datamaster/data/dokter', [DokterController::class, 'index']);
    Route::get('/datamaster/data/dokter/sync', [DokterController::class, 'sync']);
    Route::get('/datamaster/data/dokter/add', [DokterController::class, 'create']);
    Route::post('/datamaster/data/dokter/add', [DokterController::class, 'store']);
    Route::get('/datamaster/data/dokter/edit/{id}', [DokterController::class, 'edit']);
    Route::post('/datamaster/data/dokter/edit/{id}', [DokterController::class, 'update']);
    Route::get('/datamaster/data/dokter/delete/{id}', [DokterController::class, 'delete']);

    Route::get('/datamaster/data/poli', [PoliController::class, 'index']);
    Route::get('/datamaster/data/poli/sync', [PoliController::class, 'sync']);
    Route::get('/datamaster/data/poli/add', [PoliController::class, 'create']);
    Route::post('/datamaster/data/poli/add', [PoliController::class, 'store']);
    Route::get('/datamaster/data/poli/edit/{id}', [PoliController::class, 'edit']);
    Route::post('/datamaster/data/poli/edit/{id}', [PoliController::class, 'update']);
    Route::get('/datamaster/data/poli/delete/{id}', [PoliController::class, 'delete']);

    Route::get('/datamaster/data/kesadaran', [KesadaranController::class, 'index']);
    Route::get('/datamaster/data/kesadaran/sync', [KesadaranController::class, 'sync']);

    Route::get('/datamaster/data/diagnosa', [DiagnosaController::class, 'index']);
    Route::get('/datamaster/data/diagnosa/sync', [DiagnosaController::class, 'sync']);

    Route::get('/datamaster/data/provider', [ProviderController::class, 'index']);
    Route::get('/datamaster/data/provider/sync', [ProviderController::class, 'sync']);

    Route::get('/datamaster/data/tindakan', [TindakanController::class, 'index']);
    Route::get('/datamaster/data/tindakan/sync', [TindakanController::class, 'sync']);


    Route::get('/entri/data/pendaftaran', [PendaftaranController::class, 'index']);
    Route::post('/entri/data/pendaftaran', [PendaftaranController::class, 'sync']);
    //Route::get('/entri/data/pendaftaran/sync', [PendaftaranController::class, 'sync']);

    Route::get('/entri/data/pasien', [PasienController::class, 'index']);
    Route::get('/entri/data/pasien/sync', [PasienController::class, 'sync']);


    Route::get('/panggil/{id}', [BerandaController::class, 'panggil']);
    Route::get('/periksa/{id}', [BerandaController::class, 'periksa']);
    Route::get('/selesai/{id}', [BerandaController::class, 'selesai']);
    Route::get('/lewati/{id}', [BerandaController::class, 'lewati']);
});
