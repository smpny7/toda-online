<?php

namespace App\Http\Controllers;

use App\Mail\CreateComment;
use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\Explanation;
use App\Models\History;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VideosController extends Controller
{
    public function class($class_key): View
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

    public function chapter($class_key, $chapter_key): View
    {
        $videos = Video::query()
            ->where('class_key', $class_key)
            ->where('chapter_key', $chapter_key)
            ->where('active', true)
            ->groupBy('class', 'class_key', 'chapter', 'chapter_key', 'section_id', 'section_key', 'section')
            ->select('class', 'class_key', 'chapter', 'chapter_key', 'section_id', 'section_key', 'section')
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

    public function section($class_key, $chapter_key, $section_key): View
    {
        $videos = Video::query()
            ->where('class_key', $class_key)
            ->where('chapter_key', $chapter_key)
            ->where('section_key', $section_key)
            ->where('active', true)
            ->orderBy('video_id')
            ->get();

        return view('video.section')
            ->with('videos', $videos)
            ->with('class_key', $class_key)
            ->with('chapter_key', $chapter_key)
            ->with('section_key', $section_key);
    }

    public function show($class_key, $chapter_key, $section_key, $video_id): View
    {
        $video = Video::query()
            ->where('class_key', $class_key)
            ->where('chapter_key', $chapter_key)
            ->where('section_key', $section_key)
            ->where('video_id', $video_id)
            ->where('active', true)
            ->firstOrFail();

        return view('video.show')->with('video', $video);
    }

    public function switchBookmark($video_id): string
    {
        $video = Video::query()->findOrFail($video_id);
        try {
            if ($video->isBookmarked()) {
                Bookmark::query()->where('user_id', Auth::id())->where('video_id', $video_id)->delete();
                return json_encode(['success' => true, 'registered' => false]);
            } else {
                Bookmark::query()->create(['user_id' => Auth::id(), 'video_id' => $video_id, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);
                return json_encode(['success' => true, 'registered' => true]);
            }
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'errors' => ['Error' => [$e->getMessage()]]]);
        }
    }

    public function createHistory($video_id): string
    {
        try {
            History::query()->create(['user_id' => Auth::id(), 'video_id' => $video_id, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);
            return json_encode(['success' => true]);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'errors' => ['Error' => [$e->getMessage()]]]);
        }
    }

    public function createComment(Request $request, $video_id): string
    {
        try {
            Comment::query()->insert(['user_id' => Auth::id(), 'video_id' => $video_id, 'message' => $request->message, 'created_at' => new Carbon(), 'updated_at' => new Carbon()]);
            $comment = Comment::query()->latest()->first();
            $admins = User::query()->where('grade', 0)->get();
            foreach ($admins as $admin)
                Mail::to($admin->email)->send(new CreateComment($comment));
            return json_encode(['success' => true]);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'errors' => ['Error' => [$e->getMessage()]]]);
        }
    }

    public function getComments($video_id): string
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
