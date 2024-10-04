<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        // Allow from any origin
        $response = $next($request)->header('Access-Control-Allow-Origin', '*');

        // Allow specific HTTP methods
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        // Allow specific HTTP headers
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token');

        return $response;
    }
}
