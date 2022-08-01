<?php

namespace App\Http\Controllers\Api\instructors_support;
use app\Models\Instructor_support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorsSupportController extends Controller
{
    
    use ApiResponseTrait;
    public function index(){
       $instructors_support = InstructorsSupportResource ::collection(Instructor_support::get());
       return $this ->ApiResponse( $instructors_support,'done',200);
    
      
    }
    public function show($id){
        $instructors_support=Instructor_support::find($id);
        if( $instructors_support){
            return $this ->ApiResponse(new InstructorsSupportResource( $instructors_support),'done',200);
        }
        return $this ->ApiResponse(null,'this instructors_support not found', 404);
    
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|unique:admins|max:255',
            'instructor_id' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this ->ApiResponse(null,$validator->errors(), 400);
    }

    $instructors_support = Instructor_support:: create($request->all());
        if(  $instructors_support){
            return $this ->ApiResponse(new InstructorsSupportResource( $instructors_support),'this instructors_support saved',201);
        }
        return $this ->ApiResponse(null,'this instructors_support not save', 400);
    }

    public function update(Request $request ,$id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|unique:admins|max:255',
            'instructor_id' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this ->ApiResponse(null,$validator->errors(), 400);
    }
    $instructors_support = Instructor_support ::find($id);
    if (! $instructors_support){
        return $this ->ApiResponse(null,'this  instructors_support not found', 404);
    }
    $instructors_support ->update($request->all());
    if( $instructors_support){
        return $this ->ApiResponse(newInstructorsSupportResource( $instructors_support),'this instructors_support updated',201);
    }
    return $this ->ApiResponse(null,'this instructors_support not found', 404);
}
    public function destroy($id){
        $instructors_support = Instructor_support ::find($id);
    if (!$instructors_support){
        return $this ->ApiResponse(null,'this instructors_support not found', 404);
    }
    $instructors_support->delete($id);
    if($instructors_support){
        return $this ->ApiResponse(null,'this instructors_support deleted',200);
    }
    }
    }



