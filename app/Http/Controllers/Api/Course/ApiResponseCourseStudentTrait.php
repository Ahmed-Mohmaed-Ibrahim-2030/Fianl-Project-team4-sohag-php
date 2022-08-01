<?php
namespace app\Http\Controllers\Api;
 /**
  * 
  */
 trait ApiResponseCourseStudentTrait
 {
   public function ApiResponseCrstudent($data=null , $message=null ,$status=null){
    $array =[
        'data'=>$data,
        'message'=>$message,
        'status'=>$status
     ];
     return response($array,$status);
   }
 }
 