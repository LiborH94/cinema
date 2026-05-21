<?php

namespace App\Http\Middleware;

use App\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $profileUser = $request->route('user');
        $currentUser = auth()->user();

        if ($profileUser && $currentUser->id !== $profileUser->id && $currentUser->role !== UserRole::ADMIN->value) {
            abort(404);
        }
        return $next($request);
    }
}
