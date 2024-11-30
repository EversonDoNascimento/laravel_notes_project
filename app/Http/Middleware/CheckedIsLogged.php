<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckedIsLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {        
        if (!session('user')) {
            return redirect("/login");
            // ->withInput()->with('loginError','Acesso negado!')
        }
        return $next($request);
    }
}
