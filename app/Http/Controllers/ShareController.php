<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\Video;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class ShareController extends Controller
{
    /**
     * @param $id
     * @return View
     */
    public function index($id): View
    {
        $share = Share::query()->where('url', $id)->with('video')->firstOrFail();
        if(new DateTime($share->started_at) > new DateTime('now') || new DateTime($share->ended_at) < new DateTime('now'))
            abort(401);
        $video = Video::query()
            ->where('class_key', $share->video->class_key)
            ->where('chapter_key', $share->video->chapter_key)
            ->where('section_key', $share->video->section_key)
            ->where('video_id', $share->video->id)
            ->where('active', true)
            ->firstOrFail();

        return view('video.show')->with('video', $video);
    }

    public function create($video_id): View
    {
        $video = Video::query()->findOrFail($video_id);

        return view('admin.shareCreate')->with('video', $video);
    }

    public function createShareLink(Request $request, $video_id): View
    {
        $url = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 36);
        Share::query()->insert([
            'video_id' => $video_id,
            'views' => 0,
            'url' => $url,
            'started_at' => $request->start,
            'ended_at' => $request->end,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        $video = Video::query()->findOrFail($video_id);
        return view('admin.shareCreate', ['video_id' => $video_id])
            ->with('video', $video)
            ->with('url', $url);
    }
}
