<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
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
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PesertaTerdaftarController;

Route::get('/', [LoginController::class, 'showlogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('daftarantrian', [BerandaController::class, 'antrian']);
    Route::get('daftarantrian/umum', [BerandaController::class, 'antrianumum']);
    Route::post('daftarantrian/umum', [BerandaController::class, 'storeantrianumum']);
    Route::post('daftarantrian/umum/pernah', [BerandaController::class, 'storeantrianumum2']);
    Route::get('daftarantrian/bpjs', [BerandaController::class, 'antrianbpjs']);
    Route::post('daftarantrian/bpjs', [BerandaController::class, 'storeantrianbpjs']);
    Route::get('daftarantrian/bpjs/nomor', [BerandaController::class, 'checknomor']);
    Route::get('beranda', [BerandaController::class, 'index']);
    Route::get('logout', [LogoutController::class, 'logout']);
    Route::get('setting/data/bpjs', [SettingController::class, 'bpjs']);
    Route::post('setting/data/bpjs', [SettingController::class, 'updatebpjs']);
    Route::get('setting/data/bpjs/connect', [SettingController::class, 'connectBPJS']);

    Route::get('setting/data/gantipass', [SettingController::class, 'gantipass']);
    Route::post('setting/data/gantipass', [SettingController::class, 'updatepass']);

    Route::get('/datamaster/data/dokter', [DokterController::class, 'index']);
    Route::get('/datamaster/data/dokter/sync', [DokterController::class, 'sync']);
    Route::get('/datamaster/data/dokter/add', [DokterController::class, 'create']);
    Route::post('/datamaster/data/dokter/add', [DokterController::class, 'store']);
    Route::get('/datamaster/data/dokter/edit/{id}', [DokterController::class, 'edit']);
    Route::post('/datamaster/data/dokter/edit/{id}', [DokterController::class, 'update']);
    Route::get('/datamaster/data/dokter/delete/{id}', [DokterController::class, 'delete']);

    Route::get('/datamaster/data/obat', [ObatController::class, 'index']);
    Route::get('/datamaster/data/obat/add', [ObatController::class, 'create']);
    Route::post('/datamaster/data/obat/add', [ObatController::class, 'store']);
    Route::get('/datamaster/data/obat/edit/{id}', [ObatController::class, 'edit']);
    Route::post('/datamaster/data/obat/edit/{id}', [ObatController::class, 'update']);
    Route::get('/datamaster/data/obat/delete/{id}', [ObatController::class, 'delete']);

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
    Route::get('/entri/data/pendaftaran/sync/{id}', [PendaftaranController::class, 'bridgingPendaftaran']);
    Route::get('/entri/data/pendaftaran/delete/{id}', [PendaftaranController::class, 'delete']);

    Route::get('/entri/data/pelayanan', [PelayananController::class, 'index']);
    Route::post('/entri/data/pelayanan', [PelayananController::class, 'tanggal']);

    Route::get('/entri/data/pelayanan/anamnesa/{id}', [PelayananController::class, 'anamnesa']);
    Route::post('/entri/data/pelayanan/anamnesa/{id}', [PelayananController::class, 'storeAnamnesa']);
    Route::post('/entri/data/pelayanan/anamnesa/{id}/update', [PelayananController::class, 'updateAnamnesa']);

    Route::get('/entri/data/pelayanan/diagnosa/{id}', [PelayananController::class, 'diagnosa']);
    Route::post('/entri/data/pelayanan/diagnosa/{id}', [PelayananController::class, 'storeDiagnosa']);
    Route::get('/entri/data/pelayanan/diagnosa/{id}/delete', [PelayananController::class, 'deleteDiagnosa']);

    Route::get('/entri/data/pelayanan/resep/{id}', [PelayananController::class, 'resep']);
    Route::post('/entri/data/pelayanan/resep/{id}', [PelayananController::class, 'storeResep']);
    Route::get('/entri/data/pelayanan/resep/{id}/delete', [PelayananController::class, 'deleteResep']);

    Route::get('/entri/data/pelayanan/tindakan/{id}', [PelayananController::class, 'tindakan']);
    Route::post('/entri/data/pelayanan/tindakan/{id}', [PelayananController::class, 'storeTindakan']);
    Route::get('/entri/data/pelayanan/tindakan/{id}/delete', [PelayananController::class, 'deleteTindakan']);

    Route::get('/entri/data/pelayanan/selesai/{id}', [PelayananController::class, 'selesai']);
    //Route::get('/entri/data/pendaftaran/sync', [PendaftaranController::class, 'sync']);

    Route::get('/entri/data/pasien', [PasienController::class, 'index']);
    Route::get('/entri/data/pasien/add', [PasienController::class, 'create']);
    Route::get('/entri/data/pasien/delete/{id}', [PasienController::class, 'delete']);
    Route::post('/entri/data/pasien/add', [PasienController::class, 'store']);
    Route::get('/entri/data/pasien/sync', [PasienController::class, 'sync']);
    Route::get('/entri/data/pasien/edit/{id}', [PasienController::class, 'edit']);
    Route::post('/entri/data/pasien/edit/{id}', [PasienController::class, 'update']);

    Route::get('/lihat/data/peserta/terdaftar', [PesertaTerdaftarController::class, 'index']);

    Route::get('/panggil/{id}', [BerandaController::class, 'panggil']);
    Route::get('/periksa/{id}', [BerandaController::class, 'periksa']);
    Route::get('/selesai/{id}', [BerandaController::class, 'selesai']);
    Route::get('/lewati/{id}', [BerandaController::class, 'lewati']);
});
