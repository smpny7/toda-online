<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\Video;
use DateTime;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $shares = Share::query()->with('video')->get();
        return view('admin.share.index')->with('shares', $shares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $video = Video::query()->findOrFail($request->video_id);

        return view('admin.share.form')
            ->with('video', $video)
            ->with('route', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return View
     */
    public function store(Request $request): View
    {
        $url = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 36);
        Share::query()->create([
            'video_id' => $request->video_id,
            'title' => $request->title,
            'views' => 0,
            'url' => $url,
            'started_at' => $request->start,
            'ended_at' => $request->end,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        $shares = Share::query()->with('video')->get();
        return view('admin.share.index')->with('shares', $shares);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return View
     * @throws Exception
     */
    public function show($id): View
    {
        $share = Share::query()->where('url', $id)->with('video')->firstOrFail();
        if (new DateTime($share->started_at) > new DateTime('now') || new DateTime($share->ended_at) < new DateTime('now'))
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $share = Share::query()->with('video')->findOrFail($id);
        $video = $share->video;
        return view('admin.share.form')
            ->with('share', $share)
            ->with('video', $video)
            ->with('route', 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return View
     */
    public function update(Request $request, $id): View
    {
        Share::query()->findOrFail($id)->update([
            'title' => $request->title,
            'started_at' => $request->start,
            'ended_at' => $request->end
        ]);

        $shares = Share::query()->with('video')->get();
        return view('admin.share.index')->with('shares', $shares);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return View
     * @throws Exception
     */
    public function destroy($id): View
    {
        Share::query()->findOrFail($id)->delete();

        $shares = Share::query()->with('video')->get();
        return view('admin.share.index')->with('shares', $shares);
    }
}
