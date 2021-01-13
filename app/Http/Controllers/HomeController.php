<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\History;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class HomeController extends Controller
{
    public function index()
    {
        $watch_next_videos = Video::orderBy('id', 'ASC')->take(3)->get();
        foreach ($watch_next_videos as $video) {
            if (isset($video->path)) {
                $media = FFMpeg::fromDisk('local')->open('public/' . $video->path);
                $video->duration = $media->getDurationInSeconds();
                $video->thumbnail = Storage::disk('local')->url('thumbnail/' . $video->id . '.jpg');
            }
        }
        return view('home.index')->with('watch_next_videos', $watch_next_videos);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $videos = Video::where('chapter', 'LIKE', "%{$keyword}%")
            ->orWhere('section', 'LIKE', "%{$keyword}%")
            ->orWhere('title', 'LIKE', "%{$keyword}%")
            ->get();

        return view('home.search')
            ->with('videos', $videos->where('active', true))
            ->with('keyword', $keyword);
    }

    public function watchList()
    {
        $bookmarks = Bookmark::query()->where('user_id', Auth::id())->orderByDesc('created_at')->get();

        foreach ($bookmarks as $bookmark) {
            $bookmark->thumbnail = Storage::disk('local')->url('thumbnail/' . $bookmark->video->id . '.jpg');

            $bookmark->title = $bookmark->video->title;
            $bookmark->bookmark = true;

            $histories = History::query()
                ->where('user_id', Auth::id())
                ->groupBy('video_id')
                ->select('video_id')
                ->get();

            foreach ($histories as $history)
                if ($bookmark->video->id == $history->video_id)
                    $bookmark->history = true;
        }

        return view('home.watchList')
            ->with('videos', $bookmarks);
    }
}
