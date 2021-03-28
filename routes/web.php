<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\VideosController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckAttendance;
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
    return redirect()->route('home');
});

Route::get('/share/{id}', [ShareController::class, 'index'])->name('share');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/watchList', [HomeController::class, 'watchList'])->name('watchList');

    Route::post('/switchBookmark/{video_id}', [VideosController::class, 'switchBookmark'])->name('switchBookmark');
    Route::post('/createHistory/{video_id}', [VideosController::class, 'createHistory'])->name('createHistory');
    Route::post('/createComment/{video_id}', [VideosController::class, 'createComment'])->name('createComment');
    Route::post('/getComments/{video_id}', [VideosController::class, 'getComments'])->name('getComments');

    // Admin
    Route::prefix('admin')->name('admin.')->middleware([CheckAdmin::class])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/student', [AdminController::class, 'student'])->name('student');
        Route::get('/student/{id}', [AdminController::class, 'studentDetail'])->name('studentDetail');
        Route::get('/video', [AdminController::class, 'video'])->name('video');

        Route::post('/createVideoThumbnail', [AdminController::class, 'createVideoThumbnail'])->name('createVideoThumbnail');
        Route::post('/updateStudent/{id}', [AdminController::class, 'updateStudent'])->name('updateStudent');
    });

    // Video
    Route::middleware('attendance')->group(function () {
        Route::get('/{class_key}', [VideosController::class, 'class'])->name('class');
        Route::get('/{class_key}/{chapter_key}', [VideosController::class, 'chapter'])->name('chapter');
        Route::get('/{class_key}/{chapter_key}/{section_key}', [VideosController::class, 'section'])->name('section');
        Route::get('/{class_key}/{chapter_key}/{section_key}/{video_id}', [VideosController::class, 'show'])->name('show');
    });
});
