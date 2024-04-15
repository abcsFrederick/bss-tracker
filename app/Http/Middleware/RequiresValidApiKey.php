<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Spatie\FlareClient\Api;
use Symfony\Component\HttpFoundation\Response;

class RequiresValidApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->has('key') && ! $request->header('X-API-Token', false)) abort(401);

        $hasToken = ApiKey::where('api_key', '=', $request->get('key'))->count() !== 0;

        if (! $hasToken) {
            $hasToken = ApiKey::where('api_key', '=', $request->header('X-API-Token'))->count() !== 0;
        }

        if (! $hasToken) abort(401);

        return $next($request);
    }
}
