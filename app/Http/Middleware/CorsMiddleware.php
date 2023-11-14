<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        // Allow all origins
        $response = $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        // Debugging
        // $methodsHeader = $response->headers->get('Access-Control-Allow-Methods');
        // Log::info('Access-Control-Allow-Methods Header: ' . $methodsHeader);

        return $response;
    }
}

