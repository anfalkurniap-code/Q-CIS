<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // 2. Ambil role user yang sedang login
        $userRole = auth()->user()->role;

        // 3. Cek apakah rolenya kasir atau admin
        if (in_array($userRole, ['kasir', 'admin'])) {
            return $next($request);
        }

        abort(403, 'AKSES DITOLAK! HALAMAN INI KHUSUS UNTUK KASIR.');
    }
}