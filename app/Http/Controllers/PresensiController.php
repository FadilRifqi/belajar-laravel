<?php

namespace App\Http\Controllers;

use App\Models\PresensiPegawai;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function update(Request $request)
    {

        try {
            $presensi = PresensiPegawai::where('pegawai_id', $request->pegawai_id)->where('tanggal_presensi', now()->toDateString())->firstOrFail();
            if ($presensi->presensi == true) {
                return back()->with('error', 'Pegawai sudah melakukan presensi');
            }
            $presensi->update([
                'presensi' => true,
            ]);

            return back()->with('success', 'Presensi berhasil diubah');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $presensi = PresensiPegawai::where('pegawai_id', $request->pegawai_id)->where('tanggal_presensi', now()->toDateString())->firstOrFail();
            if ($presensi->presensi == false) {
                return back()->with('error', 'Pegawai belum melakukan presensi');
            }
            $presensi->update([
                'presensi' => false,
            ]);

            return back()->with('success', 'Presensi berhasil diubah');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
