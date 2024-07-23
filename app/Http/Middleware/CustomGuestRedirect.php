<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomGuestRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            if (Auth::user()->role->name == 'Admin') {
                return redirect()->route('admin');
            } else if (Auth::user()->role->name == 'Pegawai') {
                return redirect()->route('pegawai');
            }
        }
        return $next($request);
    }
}