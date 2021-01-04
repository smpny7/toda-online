<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
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

                // TODO publicディレクトリに入っているファイルは誰でもアクセスできてしまうため、公開したくないファイルの場合は別途処理が必要
                if (!Storage::disk('local')->exists('public/thumbnail/' . $video->id . '.jpg')) {
                    FFMpeg::fromDisk('local')
                        ->open('public/' . $video->path)
                        ->getFrameFromSeconds($video->duration - 1)
                        ->export()
                        ->toDisk('local')
                        ->save('public/thumbnail/' . $video->id . '.jpg');
                }

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
        $bookmarks = Bookmark::query()->where('user_id', Auth::id())->get();

        return view('home.watchList')
            ->with('bookmarks', $bookmarks);
    }
}
