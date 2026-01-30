<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekTipeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (session('tipe_user') !== 'vip') {
            return back()->with('error', 'Akses Ditolak: Fitur ini hanya untuk pengguna VIP!');
    }

    return $next($request);
}
}