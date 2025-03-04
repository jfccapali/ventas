<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Sexo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->sexo=='M'){
            return redirect()->route('bienvenido_hombre');
        }

        if(Auth::user()->sexo=='F'){
            return redirect()->route('bienvenido_mujer');
        }

        return $next($request);
    }
}
