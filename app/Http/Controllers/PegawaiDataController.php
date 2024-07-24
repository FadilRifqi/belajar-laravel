<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;


class PegawaiDataController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = User::where('role_id', 2)->orderBy('divisi_id')->paginate(10);
        return view('admin.data.app', compact('pegawai'));
    }

    public function create()
    {
        $divisi = Divisi::all();
        return view('admin.data.create', compact('divisi'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'divisi' => 'required|integer',
                'nip' => 'required|string',
            ]);

            User::create([
                'name' => $request->name,
                'divisi_id' => $request->divisi,
                'nip' => $request->nip,
                'role_id' => 2,
                'password' => bcrypt($request->name),
            ]);

            return redirect()->route('manage-pegawai')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($pegawai_id)
    {
        $pegawai = User::findOrFail($pegawai_id);
        $divisi = Divisi::all();
        return view('admin.data.edit', compact('pegawai', 'divisi'));
    }

    public function update(Request $request, $pegawai_id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'divisi' => 'required|integer',
                'nip' => 'required|string',
            ]);

            $pegawai = User::findOrFail($pegawai_id);
            $pegawai->update([
                'name' => $request->name,
                'divisi_id' => $request->divisi,
                'nip' => $request->nip,
            ]);

            return redirect()->route('manage-pegawai')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
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
        return view('admin.data.app', compact('pegawai'));
    }

    public function destroy($pegawai_id)
    {
        $pegawai = User::findOrFail($pegawai_id);
        $pegawai->delete();
        return redirect()->route('manage-pegawai')->with('success', 'Data berhasil dihapus');
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('file'));
            return back()->with('success', 'Data berhasil diimport');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
