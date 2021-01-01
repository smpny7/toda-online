<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function math1() {
        $chapters = Video::where('class', config('const.CLASS.math1'))->groupBy('chapter')->get('chapter');
        return view('class')
            ->with('class', config('const.CLASS.math1'))
            ->with('chapters', $chapters);
    }

    public function math2() {
        $chapters = Video::where('class', config('const.CLASS.math2'))->groupBy('chapter')->get('chapter');
        return view('class')
            ->with('class', config('const.CLASS.math2'))
            ->with('chapters', $chapters);
    }

    public function math3() {
        $chapters = Video::where('class', config('const.CLASS.math3'))->groupBy('chapter')->get('chapter');
        return view('class')
            ->with('class', config('const.CLASS.math3'))
            ->with('chapters', $chapters);
    }

    public function mathA() {
        $chapters = Video::where('class', config('const.CLASS.mathA'))->groupBy('chapter')->get('chapter');
        return view('class')
            ->with('class', config('const.CLASS.mathA'))
            ->with('chapters', $chapters);
    }

    public function mathB() {
        $chapters = Video::where('class', config('const.CLASS.mathB'))->groupBy('chapter')->get('chapter');
        return view('class')
            ->with('class', config('const.CLASS.mathB'))
            ->with('chapters', $chapters);
    }
}
