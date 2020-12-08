<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $watch_next_videos = Videos::orderBy('id', 'ASC')->take(3)->get();
        return view('home')->with('watch_next_videos', $watch_next_videos);
    }
}
