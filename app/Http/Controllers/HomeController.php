<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\User;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $attendance = User::query()->findOrFail(Auth::id())->attendances;
        $classes = array_map(array($this, 'getDegreeOfLearning'), array_keys(config('const.CLASS')));
        $notices = Notice::query()->orderByDesc('updated_at')->paginate(5);
        $videos = User::query()->findOrFail(Auth::id())->getBookmarkedVideos()->take(3)->get();

        return view('home.index')
            ->with('attendance', $attendance)
            ->with('classes', $classes)
            ->with('notices', $notices)
            ->with('videos', $videos);
    }

    public function notice(): View
    {
        $notices = Notice::query()->get();
        return view('home.notice')->with('notices', $notices);
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

    /**
     * @param $class_key
     * @return Int
     */
    private function getDegreeOfLearning($class_key): int
    {
        $total = 0;
        $watched = 0;
        $videos = Video::query()->where('class_key', $class_key)->get();
        foreach ($videos as $video) {
            if ($video->isWatched()) $watched++;
            $total++;
        }

        return $total == 0 ? 0 : (int)round($watched * 100 / $total);
    }
}
