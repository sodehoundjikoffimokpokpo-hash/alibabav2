<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsSupplier
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. On vérifie si l'utilisateur est connecté
        // 2. On vérifie si son rôle est bien 'supplier' ou 'admin'
        if (Auth::check() && (Auth::user()->role === 'supplier' || Auth::user()->role === 'admin')) {
            return $next($request);
        }

        // Si l'utilisateur est un simple acheteur (buyer), on le redirige avec un message d'erreur
        return redirect()->route('dashboard')->with('error', 'Accès refusé. Cette zone est réservée aux vendeurs.');
    }

}
