<?php

namespace App\Http\Controllers;

use App\Models\PresensiPegawai;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $currentYear = date('Y');
        $data = [];
        $backgroundColor = ["#FF6633", "#FFB399", "#FF33FF", "#FFFF99", "#00B3E6", "#E6B333", "#3366E6", "#999966", "#99FF99", "#B34D4D", "#80B300", "#809900"];

        for ($i = 1; $i <= 12; $i++) {
            $data[] = PresensiPegawai::whereYear('tanggal_presensi', $currentYear)->whereMonth('tanggal_presensi', $i)->where('presensi', true)->count();
        }


        return view('admin.app', compact('data', 'label', 'backgroundColor'));
    }
}
