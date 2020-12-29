<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
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
                    Log:debug((array)$video->duration);
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
        return view('home')->with('watch_next_videos', $watch_next_videos);
    }
}