<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{
    public function dashboard()
    {
        $presensi = auth()->user()->presensi;
        return view("pegawai.app", compact("presensi"));
    }
    public function index(Request $request)
    {
        $pegawai = User::where('role_id', 2)->orderBy('divisi_id')->paginate(10);
        return view('admin.manage.app', compact('pegawai'));
    }

    public function search(Request $request)
    {
        $searchTerm = '%' . $request->search . '%';

        $pegawai = User::where('role_id', 2)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhereHas('divisi', function ($query) use ($searchTerm) {
                        $query->where('nama', 'like', $searchTerm);
                    });
            })
            ->orderBy('divisi_id')
            ->paginate(10);

        $request->flashOnly(['search']);

        return view('admin.manage.app', compact('pegawai'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'presensi-pegawai-' . now()->toDateString() . '.xlsx');
    }
}
