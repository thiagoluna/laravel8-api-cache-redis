<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class GzipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (
            $request->header('Accept-Encoding') == null ||
            !str_contains($request->header('Accept-Encoding'), 'gzip')
        ) {
            return $response->withHeaders([ 'Content-Length' => strlen($response->content()) ]);
        }

        $content = gzencode($response->content(), 9);

        return $response
            ->setContent($content)
            ->withHeaders([
                'Content-Length' => strlen($content),
                'Content-Encoding' => 'gzip',
            ]);
    }
}
