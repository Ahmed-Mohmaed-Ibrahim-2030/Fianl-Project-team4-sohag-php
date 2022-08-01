<?php

namespace App\Http\Controllers;

use App\Models\courseContent;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content= courseContent::all();
        return $content;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)


    {

        error_log($id);
        return view('courses.new.addvideo',["id" => $id]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        courseContent::create([
            'content_type'=>"video" ,
            'source'=>$request->source,
            'course_id'=>$request->course_id
        ]);
        return redirect()->route('allcourses');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\courseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $cource = courseContent::where('course_id', $id)->get();
        return view("courses.new.cources_videos",["courses"=>$cource]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\courseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content= courseContent::findorFail($id);
        return $content;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\courseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $content= courseContent::findorFail($id );
        // $content->content_type=$request->content_type;
        // $content->source=$request->source;
        // $content->courseId=$request->courseId;
        // $content->save();
        $courseContent->update([
            $content=>$request->content_type,
            $content=>$request->source,
            // $content=>$request->courseId

        ]);
        return redirect()->route('courseContents.index',compact($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\courseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        courseContent::findorFail($id)->delete();
        return redirect()->route('courseContents.index');
    }
}
