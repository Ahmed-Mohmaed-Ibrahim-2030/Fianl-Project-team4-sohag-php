<?php

namespace App\Http\Controllers\Api\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\courseContent;
use Illuminate\Support\Facades\Validator;
class courseContentController extends Controller
{
    use ApiResponseCourseContentTrait;
    public function index()
    {
        $coureContents = courseContentResource::collection(courseContent::get()) ;
        return $this->ApiResponseCrCont($coureContents , 200);
        // return response($coureContent,200);
    }
    // public function show($id)
    // {
    //     $coureCont = courseContent::findorFail($id);
    //     if($coureCont){
    //         return $this->ApiResponseCrCont($coureCont , 200);
    //     }
    //     return $this->ApiResponseCrCont(null , 'course content not found' , 401);

    // }
    public function show($id)
    {
        $coureCont = new courseContentResource(courseContent::findorFail($id));
        if($coureCont){
            return $this->ApiResponseCrCont($coureCont , 200);
        }
        return $this->ApiResponseCrCont(null , 'course content not found' , 404);

    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'source' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->ApiResponseCrCont(null ,$validator->errors(), 400);
        }

        $coureCont= courseContent::create($request->all());
        if($coureCont){
            return $this->ApiResponseCrCont($coureCont , 201);
        }
        return $this->ApiResponseCrCont(null , 'course content not saved' , 400);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'source' => 'required',
        ]);

        if ($validator->fails()) { return $this->ApiResponseCrCont(null ,$validator->errors(), 400); }

        $coureCont = courseContent::find($id);
        if(!$coureCont) {  return $this->ApiResponseCrCont(null , 'course content not found' , 404);}
        $coureCont->update($request->all());
        if($coureCont) {  return $this->ApiResponseCrCont($coureCont ,'course content updated successfully', 201);}
    }


    public function destroy($id)
    {
        $coureCont = courseContent::find($id);
        if(!$coureCont) {
            return $this->ApiResponseCrCont(null , 'course content not found' , 404);
        }
        $coureCont->delete($id);
        if($coureCont) {  
            return $this->ApiResponseCrCont(null ,'course content deleted', 200);
        }

    }
}
