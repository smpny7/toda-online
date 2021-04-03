<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $attendance = User::query()->findOrFail(Auth::id())->attendances;
        $watch_next_videos = Video::orderBy('id', 'ASC')->take(3)->get();
        foreach ($watch_next_videos as $video) {
            if (isset($video->file_path)) {
                $media = FFMpeg::fromDisk('local')->open('public/' . $video->file_path);
                $video->duration = $media->getDurationInSeconds();
                $video->thumbnail = Storage::disk('local')->url('thumbnail/' . $video->id . '.jpg');
            }
        }

        return view('home.index')
            ->with('attendance', $attendance)
            ->with('watch_next_videos', $watch_next_videos);
    }

    public function search(Request $request): View
    {
        $keyword = $request->input('keyword');

        $videos = Video::query()
            ->where('chapter', 'LIKE', "%{$keyword}%")
            ->orWhere('section', 'LIKE', "%{$keyword}%")
            ->orWhere('title', 'LIKE', "%{$keyword}%")
            ->get();

        return view('home.search')
            ->with('videos', $videos->where('active', true))
            ->with('keyword', $keyword);
    }

    public function watchList(): View
    {
        $videos = Auth::user()->getBookmarkedVideos()->get();

        return view('home.watchList')
            ->with('videos', $videos);
    }
}
