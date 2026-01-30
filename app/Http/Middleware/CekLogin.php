<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekLogin
{
  public function handle($request, Closure $next)
{
    if (!session()->has('is_logged_in')) {
        return redirect('/login');
    }

    return $next($request);
}
}