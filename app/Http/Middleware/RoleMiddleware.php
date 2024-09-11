<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): mixed
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect('/login');
        }
        return $next($request);
    }
}