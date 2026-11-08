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
    // 1. Vérifie l'email, le mot de passe et connecte l'utilisateur
    $request->authenticate();

    // 2. Régénère la session pour éviter les attaques de fixation de session
    $request->session()->regenerate();

    // 3. ICI : Redirection intelligente selon le rôle de l'utilisateur
    if ($request->user()->role === 'supplier') {
        return redirect()->route('supplier.dashboard');
    }

    // Si c'est un acheteur ('buyer') ou un admin, on utilise la redirection par défaut
    return redirect()->intended(route('dashboard', absolute: false));
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
