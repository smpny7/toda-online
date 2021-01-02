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
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $path = str_replace(url('/') . '/', '', url()->current());
        foreach (config('const.CLASS') as $class_key => $class) {
            if(str_starts_with($path, $class_key)) {
                if (Auth::user()->attendances()->first()->$class_key)
                    return $next($request);
                else
                    abort(401);
            }
        }
        abort(403);
    }
}
