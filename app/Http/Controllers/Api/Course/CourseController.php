<?php

namespace App\Http\Controllers\Api\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Course_Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses =Course::join('instructors','instructors.id','courses.instructor_id')->join('users','users.id','instructors.account_id')->select('courses.*','users.first_name as instructor_first_name','users.last_name as instructor_last_name')->where('courses.reviewed',true)->get();
        return response()->json($courses);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $course =Course::join('instructors','instructors.id','courses.instructor_id')->join('users','users.id','instructors.account_id')->select('courses.*','users.first_name as instructor_first_name','users.last_name as instructor_last_name')->where('courses.id',$id)->where('courses.reviewed',true)->first();
     //   return response()->json(Course::find($id));
        return response()->json($course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function getCoursesByName($name){
return response()->json(        Course::where('name','like',"%$name%")->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function avrageRate($id){
       return response()->json(Course::find($id)->rates()->avg('rate'));
    }
    public function feedbacks($id){
       return response()->json(Course::find($id)->rates);
    }
//    public function topRates($limit){
////       return response()->json(Course_Rate::find($id)->rates()->avg('rate')->groupBy('cor'));
//
//    }
public function getTopRated($limit){
        return response()->json(Course::join('courses_rate','courses_rate.course_id','=','courses.id')->select('courses.*',DB::raw('avg(courses_rate.rate) as avrageRate'),DB::raw('count(courses_rate.course_id) as count'))->groupBy('courses.id')->orderBy('avrageRate','desc')->orderBy('count','desc')->limit($limit)->get());
}
}
