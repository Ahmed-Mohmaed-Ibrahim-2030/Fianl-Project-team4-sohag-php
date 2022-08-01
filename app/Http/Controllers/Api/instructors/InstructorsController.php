<?php

namespace App\Http\Controllers\Api\instructors;

use App\Http\Controllers\Controller;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class InstructorsController extends Controller
{
    use ApiResponseTrait;
    public function index(){
       $instructors = InstructorsResource ::collection(Instructor::get());
       return $this ->ApiResponse($instructors,'done',200);
    
      
    }
    public function show($id){
        $instructors = Instructor ::find($id);
        if( $instructors){
            return $this ->ApiResponse(new InstructorsResource( $instructors),'done',200);
        }
        return $this ->ApiResponse(null,'this instructor not found', 404);
    
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|unique:instructors|max:255',
            'email' => 'required',
            'account_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this ->ApiResponse(null,$validator->errors(), 400);
    }

    $instructors =Instructor:: create($request->all());
        if($instructors){
            return $this ->ApiResponse(new InstructorsResource( $instructors),'this instructor saved',201);
        }
        return $this ->ApiResponse(null,'this instructor not save', 400);
    }

    public function update(Request $request ,$id){
        $validator = Validator::make($request->all(), [
            'password' => 'required|unique:instructors|max:255',
            'email' => 'required',
            'account_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this ->ApiResponse(null,$validator->errors(), 400);
    }
    $instructors = Instructor ::find($id);
    if (!$instructors ){
        return $this ->ApiResponse(null,'the instructor not found', 404);
    }
    $instructors ->update($request->all());
    if( $instructors){
        return $this ->ApiResponse(new InstructorsResource( $instructors),'this instructor updated',201);
    }
    return $this ->ApiResponse(null,'this instructor not found', 404);
}
    public function destroy($id){
        $instructors  = Instructor  ::find($id);
    if (!$instructors){
        return $this ->ApiResponse(null,'the instructor not found', 404);
    }
    $instructors->delete($id);
    if( $instructors){
        return $this ->ApiResponse(null,'this instructor deleted',200);
    }
    }
    }

