<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Penting untuk cek login
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Loop semua role yang diizinkan (misal: 'admin')
        foreach ($roles as $role) {
            // 3. Cek apakah role user saat ini cocok
            if (Auth::user()->role == $role) {
                // 4. Jika cocok, izinkan akses ke halaman
                return $next($request);
            }
        }

        // 5. Jika tidak ada role yang cocok, lempar ke error 403 (Forbidden)
        abort(403, 'ANDA TIDAK MEMILIKI HAK AKSES.');
    }
}