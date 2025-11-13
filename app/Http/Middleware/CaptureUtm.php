<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CaptureUtm
{
    public function handle(Request $request, Closure $next)
    {
        $utmKeys = ['utm_source','utm_medium','utm_campaign','utm_term','utm_content','xcod'];

        foreach ($utmKeys as $key) {
            if ($request->has($key)) {
                session([$key => $request->get($key)]); // salva em session
            }
        }

        return $next($request);
    }
}
