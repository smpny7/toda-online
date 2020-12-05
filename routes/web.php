<?php

use App\Http\Controllers\VideosController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/class/{class}', [VideosController::class, 'class'])->name('class');
    Route::get('/chapter/{chapter}', [VideosController::class, 'chapter'])->name('chapter');
    Route::get('/section/{section}', [VideosController::class, 'section'])->name('section');
    Route::get('/video/{video_id}', [VideosController::class, 'video'])->name('video');

    Route::get('/home', function() {
        return view('home');
    })->name('home');

    Route::prefix('console')->name('console.')->middleware([CheckAdmin::class])->group(function () {
        Route::get('/', function() {
            return view('console.index');
        })->name('index');
    });
});
