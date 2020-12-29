<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    public function class($class) {
        $chapters = Video::where('class', $class)->groupBy('chapter')->get('chapter');
        return view('class')
            ->with('class', $class)
            ->with('chapters', $chapters);
    }

    public function chapter($chapter) {
        $sections = Video::where('chapter', $chapter)->groupBy('section')->get('section');
        return view('chapter')
            ->with('chapter', $chapter)
            ->with('sections', $sections);
    }

    public function section($section) {
        $videos = Video::where('section', $section)->where('active', true)->get();
        return view('section')
            ->with('section', $section)
            ->with('videos', $videos);
    }

    public function video($video_id) {
        $video = Video::findOrFail($video_id);
        History::insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);
        return view('video')
            ->with('video', $video);
    }

    public function protection($video_id) {
        $video = Video::findOrFail($video_id);

        abort_if(!Storage::exists('public/' . $video->path), 404);

        return response()->make(Storage::get('public/' . $video->path), 200, [
            'Content-Type'        => 'video/mp4',
            'Content-Disposition' => 'inline; filename="' . 'public/' . $video->path . '"'
        ]);
    }
}
