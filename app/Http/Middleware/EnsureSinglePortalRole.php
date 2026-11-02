<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSinglePortalRole
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $allowedRoles = explode('|', $roles);

        abort_unless(
            in_array($request->user()?->portalRole(), $allowedRoles, true),
            403
        );

        return $next($request);
    }
}
