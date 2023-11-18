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
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->header('Access-Control-Allow-Credentials', 'true');
         
        // Debugging
        // $methodsHeader = $response->headers->get('Access-Control-Allow-Methods');
        // Log::info('Access-Control-Allow-Methods Header: ' . $methodsHeader);

        return $response;

        // $response = $next($request);

        // $response->headers->set('Access-Control-Allow-Origin', '*');
        // $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        // $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        // return $response;
    }
}

