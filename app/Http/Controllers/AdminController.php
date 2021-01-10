<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function student()
    {
        $students = User::get();
        return view('admin.student')
            ->with('students', $students);
    }

    public function studentDetail($id)
    {
        $student = User::where('id', $id)->first();
        return view('admin.studentDetail')
            ->with('student', $student);
    }

    public function video()
    {
        $videos = Video::get();
        return view('admin.video')
            ->with('videos', $videos);
    }

    public function createVideoThumbnail()
    {
        $videos = Video::query()
            ->get();

        foreach ($videos as $video) {
            $media = FFMpeg::fromDisk('local')->open('public/' . $video->path);

            FFMpeg::fromDisk('local')
                ->open('public/' . $video->path)
                ->getFrameFromSeconds($media->getDurationInSeconds() - 1)
                ->export()
                ->toDisk('local')
                ->save('public/thumbnail/' . $video->id . '.jpg');
        }

        return view('admin.index');
    }

    public function updateStudent(Request $request, $id)
    {
        if (isset($request->math1))
            User::where('id', $id)
                ->update(['math1' => $request->math1, 'math2' => $request->math2, 'math3' => $request->math3, 'mathA' => $request->mathA, 'mathB' => $request->mathB]);

        else if (isset($request->grade))
            User::where('id', $id)
                ->update(['grade' => $request->grade]);

        if (isset($request->math1))
            return redirect()->route('admin.studentDetail', ['id' => $id]);
        else
            return redirect()->route('admin.student');
    }
}
