<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (Auth::check()) {
        // Jika sudah login, arahkan ke halaman dashboard atau admin
        $user = Auth::user();
        return $user->role === 'admin' 
            ? redirect()->route('menus.index') 
            : redirect()->route('dashboard');
    }

    return $next($request);
}
}
