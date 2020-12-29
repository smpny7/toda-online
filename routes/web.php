<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/class/{class}', [VideosController::class, 'class'])->name('class');
    Route::get('/chapter/{chapter}', [VideosController::class, 'chapter'])->name('chapter');
    Route::get('/section/{section}', [VideosController::class, 'section'])->name('section');
    Route::get('/video/{video_id}', [VideosController::class, 'video'])->middleware([CheckAttendance::class])->name('video');

    Route::get('/video/show/{video_id}', [VideosController::class, 'protection'])->name('protection');

    Route::prefix('admin')->name('admin.')->middleware([CheckAdmin::class])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/student', [AdminController::class, 'student'])->name('student');
        Route::get('/student/{id}', [AdminController::class, 'studentDetail'])->name('studentDetail');
        Route::get('/video', [AdminController::class, 'video'])->name('video');

        Route::post('/updateStudent/{id}', [AdminController::class, 'updateStudent'])->name('updateStudent');
    });
});
