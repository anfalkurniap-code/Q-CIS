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
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (in_array($userRole, ['kasir', 'admin'])) {
            return $next($request);
        }

        if ($userRole === 'kasir') {
            return $next($request);
        }

        abort(403, 'AKSES DITOLAK! HALAMAN INI KHUSUS UNTUK KASIR.');
    }
}
