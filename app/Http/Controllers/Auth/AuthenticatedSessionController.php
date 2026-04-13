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
    public function store(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // --- LOGIKA REDIRECT CERDAS BERDASARKAN ROLE ---
        $user = $request->user();
        $url = '/'; // Default: Lempar ke halaman depan ala Bridestory

        if ($user->role === 'admin') {
            $url = '/admin/dashboard';
        } elseif ($user->role === 'vendor') {
            $url = '/vendor/dashboard';
        }

        // Intended: Lempar ke URL yang dituju, tapi kalau tidak ada, ikuti $url di atas
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
