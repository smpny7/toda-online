<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\Explanation;
use App\Models\History;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideosController extends Controller
{
    public function class($class_key)
    {
        $videos = Video::query()
            ->where('class_key', $class_key)
            ->where('active', true)
            ->groupBy('class', 'chapter_id', 'chapter_key', 'chapter')
            ->select('class', 'chapter_id', 'chapter_key', 'chapter')
            ->orderBy('chapter_id')
            ->get();

        foreach ($videos as $video) {
            $watched = 0;

            $chapter_videos = Video::query()
                ->where('class_key', $class_key)
                ->where('chapter_key', $video->chapter_key)
                ->where('active', true)
                ->get();

            $histories = History::query()
                ->where('user_id', Auth::id())
                ->groupBy('video_id')
                ->select('video_id')
                ->get();

            foreach ($chapter_videos as $chapter_video) {
                foreach ($histories as $history)
                    if ($chapter_video->id == $history->video_id)
                        $watched++;
            }

            $video->watched = round($watched * 100 / $chapter_videos->count());

            $video->subtitles = $chapter_videos
                ->toQuery()
                ->groupBy('section_id', 'section')
                ->orderBy('section_id')
                ->get('section');
        }

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
            ->groupBy('chapter', 'section_id', 'section_key', 'section')
            ->select('chapter', 'section_id', 'section_key', 'section')
            ->orderBy('section_id')
            ->get();

        foreach ($videos as $video) {
            $watched = 0;

            $section_videos = Video::query()
                ->where('class_key', $class_key)
                ->where('chapter_key', $chapter_key)
                ->where('section_key', $video->section_key)
                ->where('active', true)
                ->get();

            $histories = History::query()
                ->where('user_id', Auth::id())
                ->groupBy('video_id')
                ->select('video_id')
                ->get();

            foreach ($section_videos as $section_video) {
                foreach ($histories as $history)
                    if ($section_video->id == $history->video_id)
                        $watched++;
            }

            $video->watched = $watched;
            $video->all = $section_videos->count();
        }

        $explanation = Explanation::query()
            ->where('class_key', $class_key)
            ->where('chapter_key', $chapter_key)
            ->first();

        return view('video.chapter')
            ->with('videos', $videos)
            ->with('explanation', $explanation)
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
            ->orderBy('video_id')
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

        $bookmarked = Bookmark::query()->where('user_id', Auth::id())->where('video_id', $video->id)->exists();

        $video->filesize = Storage::disk('local')->size('public/' . $video->path);

        $media = FFMpeg::fromDisk('local')->open('public/' . $video->path);
        $video->duration = $media->getDurationInSeconds();

        $video->watched = History::query()
            ->where('user_id', Auth::id())
            ->where('video_id', $video->id)
            ->first();

        $comment_count = Comment::query()
            ->where('video_id', $video->id)
            ->where('disabled', false)
            ->count();

        return view('video.show')
            ->with('video', $video)
            ->with('bookmarked', $bookmarked)
            ->with('comment_count', $comment_count);
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

    public function switchBookmark($video_id)
    {
        try {
            if (Bookmark::query()->where('user_id', Auth::id())->where('video_id', $video_id)->exists()) {
                Bookmark::query()->where('user_id', Auth::id())->where('video_id', $video_id)->delete();
                return json_encode(['success' => true, 'registered' => false]);
            } else {
                Bookmark::query()->insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);
                return json_encode(['success' => true, 'registered' => true]);
            }
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'errors' => ['Error' => [$e->getMessage()]]]);
        }
    }

    public function createHistory($video_id)
    {
        try {
            History::query()->insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);
            return json_encode(['success' => true]);
        } catch (\Exception $e) {
            return json_encode(['success' => false]);
        }
    }

    public function createComment(Request $request, $video_id)
    {
        try {
            Comment::query()->insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'message' => $request->message, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);
            return json_encode(['success' => true, 'message' => ['Created Successfully!!!']]);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'errors' => ['Error' => [$e->getMessage()]]]);
        }
    }

    public function getComments($video_id)
    {
        try {
            $comments = Comment::query()->where('video_id', $video_id)->where('disabled', false)->get();
            foreach ($comments as $comment)
                $comment->user = User::query()->findOrFail($comment->user_id);
            return json_encode(['success' => true, 'comments' => $comments]);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'errors' => ['Error' => [$e->getMessage()]]]);
        }
    }
}
