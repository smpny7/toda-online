<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\History;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

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
        $video = Video::query()
            ->where('class_key', $class_key)
            ->where('chapter_key', $chapter_key)
            ->where('section_key', $section_key)
            ->where('video_id', $video_id)
            ->where('active', true)
            ->first();

        if (!$video)
            abort(401);

        $bookmarked = Bookmark::query()->where('user_id', Auth::id())->where('video_id', $video_id)->exists();

        Log::debug($bookmarked);

        $video->filesize = Storage::disk('local')->size('public/' . $video->path);

        $media = FFMpeg::fromDisk('local')->open('public/' . $video->path);
        $video->duration = $media->getDurationInSeconds();

        $video->watched = History::query()
            ->where('user_id', Auth::id())
            ->where('video_id', $video_id)
            ->first();

        $comments = Comment::query()
            ->where('video_id', $video->id)
            ->where('disabled', false)
            ->get();

//        TODO: ビデオ再生時に変更
//        History::insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);

        return view('video.show')
            ->with('video', $video)
            ->with('bookmarked', $bookmarked)
            ->with('comments', $comments);
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

    public function createComment(Request $request, $video_id)
    {
        Comment::query()->insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'message' => $request->message, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);
        $video = Video::query()->findOrFail($video_id);

        return redirect()->route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video_id]);
    }

    public function createBookmark($video_id)
    {
        if (Bookmark::query()->where('user_id', Auth::id())->where('video_id', $video_id)->exists())
            Bookmark::query()->where('user_id', Auth::id())->where('video_id', $video_id)->delete();
        else
            Bookmark::query()->insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);

        $video = Video::query()->findOrFail($video_id);

        return redirect()->route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video_id]);
    }
}
