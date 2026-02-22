<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Si el usuario no está logueado o su rol no coincide
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Acceso no autorizado'); // Devuelve error 403
        }

        return $next($request); // Si todo está bien, deja pasar la petición
    }
}
