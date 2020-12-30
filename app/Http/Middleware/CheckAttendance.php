<?php

namespace App\Http\Middleware;

use App\Models\Video;
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
        $video = Video::where('id', $video_id)->first();
        if (!$video->active) abort(401);
        foreach (config('const.CLASS') as $class_key => $class) {
            if ((bool)$class == $video->class) {
                if (Auth::user()->attendances()->first()->$class_key)
                    return $next($request);
                else
                    abort(401);
            }
        }
        abort(403);
    }
}
