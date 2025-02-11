<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            if (Auth::user()->role == $role) {
                return $next($request);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
