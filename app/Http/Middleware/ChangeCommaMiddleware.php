<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeCommaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->outfit_price) {
            $commaReplace = str_replace(',', '.', $request->outfit_price);
            $request->merge(['outfit_price' =>  $commaReplace]);
        }

        return $next($request);
    }
}
