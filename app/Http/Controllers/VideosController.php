<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $video_path = Storage::disk('local')->url('public/' . $video->path);
        return view('video')
            ->with('video', $video)
            ->with('video_path', $video_path);
    }

    public function protection($video_id) {
        $video = Videos::findOrFail($video_id);
        Log::debug('public/' . $video->path);

        abort_if(!Storage::exists('public/' . $video->path), 404);

        return response()->make(Storage::get('public/' . $video->path), 200, [
            'Content-Type'        => 'video/mp4',
            'Content-Disposition' => 'inline; filename="' . 'public/' . $video->path . '"'
        ]);
    }
}
