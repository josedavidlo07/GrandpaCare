<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es un doctor
        if (Auth::check() && Auth::user()->esDoctor()) {
            return $next($request); // Deja pasar al siguiente middleware/controlador
        }

        // Si no es doctor, redirige a otra página o muestra un error
        return redirect()->route('home')->with('error', 'Acceso no autorizado');
    }
}
