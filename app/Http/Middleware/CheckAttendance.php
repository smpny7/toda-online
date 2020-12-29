<?php

namespace App\Http\Middleware;

use App\Models\Videos;
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
        $video_id = str_replace(url('/') . '/video/', '', url()->current());
        $video = Videos::where('id', $video_id)->first();
        foreach (config('const.CLASS') as $class_key => $class) {
            if ((bool) $class == $video->class) {
                if(Auth::user()->$class_key)
                    return $next($request);
                else
                    abort(401);
            }
        }
        abort(403);
    }
}
