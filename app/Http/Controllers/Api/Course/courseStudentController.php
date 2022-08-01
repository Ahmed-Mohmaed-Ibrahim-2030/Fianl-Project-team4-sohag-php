<?php

namespace App\Http\Controllers\Api\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\courseStudent;
use Illuminate\Support\Facades\Validator;

class courseStudentController extends Controller
{
    use ApiResponseCourseStudentTrait;

    public function index()
    {
        $coureStudents = courseStudentResource::collection(courseStudent::get()) ;
        return $this->ApiResponseCrstudent($coureStudents , 200);
    }

    public function show($id)
    {
        $courestudent = new courseStudentResource(courseStudent::findorFail($id));
        if($courestudent){
            return $this->ApiResponseCrstudent($courestudent , 200);
        }
        return $this->ApiResponseCrstudent(null , 'course student not found' , 404);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mark' => 'required',
            'status'=>'required',
            'studentId'=> 'required',
            'courseId' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->ApiResponseCrstudent(null ,$validator->errors(), 400);
        }

        $courestudent= courseStudent::create($request->all());
        if($courestudent){
            return $this->ApiResponseCrstudent($coureCont , 201);
        }
        return $this->ApiResponseCrstudent(null , 'course student not saved' , 400);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mark' => 'required',
            'status'=>'required',
            'studentId'=> 'required',
            'courseId' => 'required'
        ]);

        if ($validator->fails()) { return $this->ApiResponseCrstudent(null ,$validator->errors(), 400); }

        $courestudent = courseStudent::find($id);
        if(!$courestudent) {  return $this->ApiResponseCrstudent(null , 'course student not found' , 404);}
        $coureCont->update($request->all());
        if($courestudent) {  return $this->ApiResponseCrstudent($courestudent ,'course student updated successfully', 201);}
    }


    public function destroy($id)
    {
        $coureCont = courseStudent::find($id);
        if(!$courestudent) {
            return $this->ApiResponseCrstudent(null , 'course student not found' , 404);
        }
        $courestudent->delete($id);
        if($courestudent) {  
            return $this->ApiResponseCrstudent(null ,'course student deleted', 200);
        }

    }

}
