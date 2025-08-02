<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('user')->check()) {  // or just auth()->check()
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only authenticated users can access this route.',
            ], 401);
        }
        return $next($request);
    }
}
