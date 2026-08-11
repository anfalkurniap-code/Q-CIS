<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user ada di dalam daftar role yang diizinkan untuk route tersebut
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // 3. Jika tidak sesuai role-nya
        abort(403, 'AKSES DITOLAK! Anda tidak memiliki hak akses ke halaman ini.');
    }
}