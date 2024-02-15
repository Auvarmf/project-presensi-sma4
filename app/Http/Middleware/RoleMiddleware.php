<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if ($request->user() === null) {
            abort(403, 'Unauthorized action.');
        }

        // Memeriksa apakah peran pengguna termasuk dalam daftar peran yang diizinkan
        foreach ($roles as $role) {
            if ($request->user()->role == $role) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}