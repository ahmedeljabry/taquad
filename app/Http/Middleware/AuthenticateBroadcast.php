<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateBroadcast
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            return $next($request);
        }

        $sanctum = Auth::guard('sanctum');

        if (method_exists($sanctum, 'setRequest')) {
            $sanctum->setRequest($request);
        }

        if ($user = $sanctum->user()) {
            Auth::setUser($user);

            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }
}
