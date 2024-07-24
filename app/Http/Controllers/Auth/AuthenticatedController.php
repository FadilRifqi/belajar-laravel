<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticatedController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        try {
            $credentials = $request->validate(
                [
                    'name' => 'required',
                    'password' => 'required',
                ]
            );

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                if (auth()->user()->role->name === 'Admin') {
                    return redirect()->route('admin');
                } elseif (auth()->user()->role->name === 'Pegawai') {
                    return redirect()->route('pegawai');
                }
            }

            return back()->with('error', 'Invalid credentials');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
