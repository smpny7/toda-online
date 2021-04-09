<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }

    public function video(): View
    {
        $videos = Video::query()->get();
        return view('admin.video.index')->with('videos', $videos);
    }

    public function createVideoThumbnail(): View
    {
        $videos = Video::query()->get();

        foreach ($videos as $video) {
            $media = FFMpeg::fromDisk('local')->open('public/' . $video->file_path);

            FFMpeg::fromDisk('local')
                ->open('public/' . $video->file_path)
                ->getFrameFromSeconds($media->getDurationInSeconds() - 1)
                ->export()
                ->toDisk('local')
                ->save('public/thumbnail/' . $video->id . '.jpg');
        }

        return view('admin.index');
    }
}
