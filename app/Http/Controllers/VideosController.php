<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    public function class($class_key)
    {
        $videos = Video::query()
            ->where('class_key', $class_key)
            ->where('active', true)
            ->groupBy('class', 'chapter_key', 'chapter')
            ->select('class', 'chapter_key', 'chapter')
            ->get();

        return view('video.class')
            ->with('videos', $videos)
            ->with('class_key', $class_key);
    }

    public function chapter($class_key, $chapter_key)
    {
        $videos = Video::query()
            ->where('class_key', $class_key)
            ->where('chapter_key', $chapter_key)
            ->where('active', true)
            ->groupBy('chapter', 'section_key', 'section')
            ->select('chapter', 'section_key', 'section')
            ->get();

        return view('video.chapter')
            ->with('videos', $videos)
            ->with('class_key', $class_key)
            ->with('chapter_key', $chapter_key);
    }

    public function section($class_key, $chapter_key, $section_key)
    {
        $videos = Video::query()
            ->where('class_key', $class_key)
            ->where('chapter_key', $chapter_key)
            ->where('section_key', $section_key)
            ->where('active', true)
            ->groupBy('section', 'video_id', 'title')
            ->select('section', 'video_id', 'title')
            ->get();

        return view('video.section')
            ->with('videos', $videos)
            ->with('class_key', $class_key)
            ->with('chapter_key', $chapter_key)
            ->with('section_key', $section_key);
    }

    public function show($class_key, $chapter_key, $section_key, $video_id)
    {
        $users = User::query()->get();

        $video = Video::query()
            ->where('class_key', $class_key)
            ->where('chapter_key', $chapter_key)
            ->where('section_key', $section_key)
            ->where('video_id', $video_id)
            ->where('active', true)
            ->first();

        if (!$video)
            abort(401);

//        TODO: ビデオ再生時に変更
        History::insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);

        return view('video.show')
            ->with('users', $users)
            ->with('video', $video);
    }

    public function protection($video_id)
    {
        $video = Video::findOrFail($video_id);

        abort_if(!Storage::exists('public/' . $video->path), 404);

        return response()->make(Storage::get('public/' . $video->path), 200, [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'inline; filename="' . 'public/' . $video->path . '"'
        ]);
    }
}
