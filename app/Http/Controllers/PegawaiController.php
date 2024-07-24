<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = User::where('role_id', 2)->orderBy('divisi')->paginate(10);
        return view('admin.manage.app', compact('pegawai'));
    }
}
