<?php

namespace App\Http\Middleware;

use Closure;

class AddAcceptAndContentTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd("SHIT");

        $request->headers->add([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ]);

        return $next($request);
    }
}
