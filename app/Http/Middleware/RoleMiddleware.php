<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check if the user has the required role
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // Redirect to the client dashboard by default
        return redirect()->route('client.dashboard');
    }
}
