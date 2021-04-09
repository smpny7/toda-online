<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $students = User::query()->get();
        return view('admin.student.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id): View
    {
        $student = User::query()->findOrFail($id);
        return view('admin.student.form')
            ->with('student', $student)
            ->with('mode', 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $student = User::query()->findOrFail($id);
        return view('admin.student.form')
            ->with('student', $student)
            ->with('mode', 'edit');
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
        $user = User::query()->findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->grade = $request->grade;
        $user->save();

        $attendance = Attendance::query()->findOrFail($id);
        foreach (config('const.CLASS') as $class_key => $class)
            $attendance->$class_key = $request->$class_key == 'on';
        $attendance->save();

        $student = User::query()->findOrFail($id);
        return view('admin.student.form')
            ->with('student', $student)
            ->with('mode', 'show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
