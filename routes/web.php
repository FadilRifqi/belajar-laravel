<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegawaiDataController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\TicketAdminController;
use App\Http\Controllers\TicketController;
use App\Livewire\Chat;
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
        //ticket
        Route::get('/ticket', [TicketAdminController::class, 'index'])->name('ticket.admin');
        Route::put('/ticket/close/{ticket_id}', [TicketAdminController::class, 'closeTicket'])->name('ticket.close');
        Route::get('/ticket/open/{ticket_id}', [TicketAdminController::class, 'openTicket'])->name('ticket.open');
        Route::get('/ticket/solve/{ticket_id}', [TicketAdminController::class, 'solveTicket'])->name('ticket.solve');
        Route::delete('/ticket/delete/{ticket_id}', [TicketAdminController::class, 'destroy'])->name('ticket.delete');
    });

    Route::group(['middleware' => 'pegawai', 'prefix' => 'pegawai'], function () {
        //dashboard
        Route::get('/', function () {
            return view('pegawai.app');
        })->name('pegawai');
        //scan qr
        Route::get('/scan', function () {
            return view('pegawai.scan.app');
        })->name('scan');
        Route::post('/absen/{token}', [QrCodeController::class, 'store'])->name('absen');
        //open ticket
        Route::get('/ticket', [TicketController::class, 'index'])->name('ticket');
        Route::post('/ticket', [TicketController::class, 'store']);
    });

    Route::get('/chat', Chat::class)->name('chat');
    Route::get('logout', [AuthenticatedController::class, 'destroy'])->name('logout');
    Route::post('/logout', [AuthenticatedController::class, 'destroy']);
});