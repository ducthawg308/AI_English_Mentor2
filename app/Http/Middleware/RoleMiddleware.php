<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!Auth::check() || !in_array(Auth::user()->role,$roles))
        {
            // return response()->view('errors.unauthorized');
            return Inertia::render('errors/NotFound')->toResponse($request)->setStatusCode(404);
        }
        return $next($request);
    }
}
