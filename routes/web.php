<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegawaiDataController;
use App\Http\Controllers\PresensiController;
use App\Http\Middleware\Pegawai;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\QrCodeController;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthenticatedController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedController::class, 'store']);

});


Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'admin', "prefix" => 'admin'], function () {
        Route::get('/', function () {
            return view('admin.app');
        })->name('admin');
        Route::get('/generate-qrcode', [QrCodeController::class, 'create'])->name('generate');
        //Route Presensi Controller
        Route::post('/export/pegawai', [PegawaiController::class, 'export'])->name('export');
        Route::get('/manage', [PegawaiController::class, 'index'])->name('manage-presensi');
        Route::post('/manage', [PegawaiController::class, 'search'])->name('manage-presensi.search');
        Route::patch('/presensi/{pegawai_id}', [PresensiController::class, 'update'])->name('presensi.hadir');
        Route::patch('/presensi-hapus/{pegawai_id}', [PresensiController::class, 'destroy'])->name('presensi.hapus');
        //Route Pegawai Controller
        Route::get('/data', [PegawaiDataController::class, 'index'])->name('manage-pegawai');
        Route::post('/data', [PegawaiDataController::class, 'search'])->name('manage-pegawai.search');
        Route::get('/data/create/{pegawai_id}', [PegawaiDataController::class, 'create'])->name('data.create');
        Route::post('/data/create/{pegawai_id}', [PegawaiDataController::class, 'store'])->name('data.store');
        Route::get('/data/edit/{pegawai_id}', [PegawaiDataController::class, 'edit'])->name('data.edit');
        Route::put('/data/edit/{pegawai_id}', [PegawaiDataController::class, 'store'])->name('data.update');
        Route::delete('/data/{pegawai_id}', [PegawaiDataController::class, 'destroy'])->name('data.hapus');
        Route::post('/data/import', [PegawaiDataController::class, 'import'])->name('data.import');
    });

    Route::group(['middleware' => 'pegawai', 'prefix' => 'pegawai'], function () {
        Route::get('/', function () {
            return view('pegawai.app');
        })->name('pegawai');
        Route::get('/scan', function () {
            return view('pegawai.scan.app');
        })->name('scan');
        Route::post('/absen/{token}', [QrCodeController::class, 'store'])->name('absen');
    });

    Route::get('/chat', function () {
        return response()->json([
            'message' => 'Chat feature is under development'
        ]);
    })->name('chat');
    Route::get('logout', [AuthenticatedController::class, 'destroy'])->name('logout');
    Route::post('/logout', [AuthenticatedController::class, 'destroy']);
});