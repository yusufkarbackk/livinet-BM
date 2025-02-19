<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
         // Allow CORS
        $response->headers->set('Access-Control-Allow-Origin', '*');  // Allow all origins (for dev, change to specific domain in prod)
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, X-CSRF-Token, Authorization');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        return $response;
    }
}
