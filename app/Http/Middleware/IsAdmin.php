<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // lanjutkan jika admin
        }

        // Kalau bukan admin, tampilkan 404 Not Found
        abort(404);
        // Atau bisa juga abort(403, 'Unauthorized'); untuk pesan khusus
    }
}
