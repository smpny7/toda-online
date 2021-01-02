<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAttendance
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $class
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $class)
    {
        if (Auth::user()->attendances()->first()->$class)
            return $next($request);
        else
            abort(401);
    }
}
