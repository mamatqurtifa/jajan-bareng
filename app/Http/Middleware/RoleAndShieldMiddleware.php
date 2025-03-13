<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAndShieldMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user->hasRole('user')) {
            return response()->view('errors.403', [], 403);
        }

        if (!$user->hasRole('super_admin', 'organization_admin')) {
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
