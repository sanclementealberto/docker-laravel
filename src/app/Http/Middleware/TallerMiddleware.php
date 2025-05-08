<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class TallerMiddleware
{
    /**
     * Handle an incoming request.
     *proteger las rutas para que solo los roles taller puedan acceder
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'taller') {
            return $next($request);
        }
        return redirect()->route('index')->with('error', 'solo el taller  puede modificar citas');
        
    }
}
