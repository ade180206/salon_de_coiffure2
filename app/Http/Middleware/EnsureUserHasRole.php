<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;     
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        $expectedRole = UserRole::tryFrom($role);

        if (!$user || !$expectedRole || $user->Role !== $expectedRole) {
            abort(403, 'Accès interdit à l\'utilisateur.');
        }

        return $next($request);
    }
}
