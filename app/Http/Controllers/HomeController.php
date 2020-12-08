<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class HomeController extends Controller
{
    public function index()
    {
        $watch_next_videos = Videos::orderBy('id', 'ASC')->take(3)->get();
        foreach ($watch_next_videos as $video) {
            if (isset($video->path)) {
                $media = FFMpeg::open($video->path);
                $video->duration = $media->getDurationInSeconds();
            }
        }
        return view('home')->with('watch_next_videos', $watch_next_videos);
    }
}
