<?php

use App\Http\Controllers\PegawaiController;
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
        Route::get('/manage', [PegawaiController::class, 'index'])->name('manage');
        Route::patch('/presensi/{pegawai_id}', [PresensiController::class, 'update'])->name('presensi.hadir');
        Route::patch('/presensi-hapus/{pegawai_id}', [PresensiController::class, 'destroy'])->name('presensi.hapus');

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