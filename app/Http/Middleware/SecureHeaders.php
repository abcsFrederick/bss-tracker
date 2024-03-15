<?php

namespace App\Http\Middleware;

use Closure;

class SecureHeaders
{
    // Enumerate headers which you do not want in your application's responses.
    // Great starting point would be to go check out @Scott_Helme's:
    // https://securityheaders.com/
    private $unwantedHeaderList = [
        'X-Powered-By',
        'Server',
    ];
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $this->removeUnwantedHeaders($response, $this->unwantedHeaderList);

        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Strict-Transport-Security', 'max-age:31536000; includeSubDomains');

        if (env('APP_ENV') !== 'local') {
            $response->headers->set('Content-Security-Policy', "style-src 'self' 'unsafe-inline' https://fonts.bunny.net");
        }

        return $response;
    }

    private function removeUnwantedHeaders($response, $headerList)
    {
        foreach ($headerList as $header) {
            header_remove($header);
            $response->headers->remove($header);
        }
    }
}
