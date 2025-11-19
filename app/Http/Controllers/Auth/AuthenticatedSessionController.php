<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // 2. Buat ulang sesi
        $request->session()->regenerate();

        // 3. LOGIKA REDIRECT BERDASARKAN ROLE (BARU)
        $url = '';
        if (Auth::user()->role == 'admin') {
            // Jika admin, arahkan ke dashboard admin
            $url = route('admin.dashboard');
        } else {
            // Jika bukan, arahkan ke dashboard mahasiswa
            $url = route('dashboard');
        }

        // 4. Arahkan ke URL yang dituju
        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
