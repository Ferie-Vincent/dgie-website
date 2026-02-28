<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChangeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->must_change_password) {
            if (!$request->routeIs('admin.password.change') && !$request->routeIs('admin.password.update') && !$request->routeIs('admin.logout')) {
                return redirect()->route('admin.password.change')
                    ->with('warning', 'Vous devez changer votre mot de passe avant de continuer.');
            }
        }

        return $next($request);
    }
}
