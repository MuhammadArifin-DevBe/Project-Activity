<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        if (!$request->user()->hasRole($role)) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
