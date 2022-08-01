<?php

namespace App\Http\Controllers;

use App\Models\courseStudent;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseStudent=courseStudent::all();
        return $courseStudent;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        courseStudent::create([
            'mark'=>$request->mark,
            'status'=>$request->status,
            'studentId'=>$request->studentId,
            'courseId'=>$request->courseId
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\courseStudent  $courseStudent
     * @return \Illuminate\Http\Response
     */
    public function show(courseStudent $courseStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\courseStudent  $courseStudent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courseStudent=courseStudent::findorFail($id);
        return $courseStudent;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\courseStudent  $courseStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $courseStudent =courseStudent::findorFail($id);
        $courseStudent->update([
            $courseStudent =>$request->mark,
            $courseStudent =>$request->status,
            $courseStudent =>$request->studentId,
            $courseStudent =>$request->courseId
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\courseStudent  $courseStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(courseStudent $courseStudent)
    {
        $courseStudent =courseStudent::findorFail($id)->delete();
        return redirect()->route('courseStudent.index');
    }
}
