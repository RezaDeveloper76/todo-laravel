<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class apiLogin
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
        if (!Auth::check()) {
            return response()->json([
                'status' => 0,
                'msg' => 'login faild'
            ]);
        }
        return $next($request);
    }
}
