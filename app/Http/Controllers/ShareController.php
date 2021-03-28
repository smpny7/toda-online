<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\Video;
use Illuminate\Contracts\View\View;

class ShareController extends Controller
{
    /**
     * @param $id
     * @return View
     */
    public function index($id): View
    {
        $share = Share::query()->where('url', $id)->with('video')->firstOrFail();
        $video = Video::query()
            ->where('class_key', $share->video->class_key)
            ->where('chapter_key', $share->video->chapter_key)
            ->where('section_key', $share->video->section_key)
            ->where('video_id', $share->video->id)
            ->where('active', true)
            ->firstOrFail();

        return view('video.show')->with('video', $video);
    }
}
