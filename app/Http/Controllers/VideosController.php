<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideosController extends Controller
{
    public function class($class) {
        $chapters = Videos::where('class', $class)->groupBy('chapter')->get('chapter');
        return view('class')
            ->with('class', $class)
            ->with('chapters', $chapters);
    }

    public function chapter($chapter) {
        $sections = Videos::where('chapter', $chapter)->groupBy('section')->get('section');
        return view('chapter')
            ->with('chapter', $chapter)
            ->with('sections', $sections);
    }

    public function section($section) {
        $videos = Videos::where('section', $section)->get();
        return view('section')
            ->with('section', $section)
            ->with('videos', $videos);
    }

    public function video($video_id) {
        $video = Videos::findOrFail($video_id);
        return view('video')->with('video', $video);
    }
}
