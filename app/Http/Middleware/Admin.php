<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki level admin
        if (Auth::check() && Auth::user()->level == 'admin') {
            return $next($request); // Lanjutkan ke halaman admin
        }
        // Jika bukan admin, arahkan ke halaman beranda
        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
