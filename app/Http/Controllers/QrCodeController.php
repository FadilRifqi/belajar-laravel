<?php

namespace App\Http\Controllers;

use App\Models\PresensiPegawai;
use App\Models\PresensiQr;
use App\Models\User;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class QrCodeController extends Controller
{
    public function create()
    {
        $pegawai = User::where('role_id', 2)->get();
        foreach ($pegawai as $p) {
            $presensi = $p->presensi->where('tanggal_presensi', now()->toDateString())->first();
            if (!$presensi) {
                PresensiPegawai::create([
                    'pegawai_id' => $p->id,
                    'tanggal_presensi' => now(),
                    'presensi' => false,
                ]);
            }
        }
        $qr_code = PresensiQr::where('tanggal_presensi', now()->toDateString())->first();
        if (!$qr_code || $qr_code->expired_at->isPast()) {
            $qr_code = PresensiQr::create([
                'token' => md5(now()),
                'tanggal_presensi' => now(),
                'expired_at' => Carbon::tomorrow()->startOfDay(),
            ]);
        }

        $qr_code_image = QrCode::size(300)
            ->color(0, 0, 139)
            ->backgroundColor(255, 179, 71)
            ->generate($qr_code->token);
        $qr_code_base64 = 'data:image/svg+xml;base64,' . base64_encode($qr_code_image);
        return view('admin.generate.app', compact('qr_code_base64'));
    }

    public function store(Request $request, $token)
    {
        $qr_code = PresensiQr::where('token', $token)->first();

        if (!$qr_code || $qr_code->expired_at->isPast()) {
            return response()->json(['status' => 'error', 'message' => 'Token QR Code tidak valid'], 400);
        }

        $presensi = PresensiPegawai::where('presensi', false)
            ->where('pegawai_id', auth()->user()->id)
            ->where('tanggal_presensi', now()->toDateString())
            ->first();

        if (!$presensi) {
            return response()->json(['status' => 'error', 'message' => 'Anda sudah melakukan presensi hari ini'], 400);
        }

        $presensi->update(['presensi' => true]);

        return response()->json(['status' => 'success', 'message' => 'Presensi berhasil', 'redirect_url' => route('pegawai')]);
    }
}
