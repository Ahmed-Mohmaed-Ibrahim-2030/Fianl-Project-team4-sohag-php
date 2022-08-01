<?php
namespace app\Http\Controllers\Api;
 /**
  * 
  */
 trait ApiResponseCourseContentTrait
 {
   public function ApiResponseCrCont($data=null , $message=null ,$status=null){
    $array =[
        'data'=>$data,
        'message'=>$message,
        'status'=>$status
     ];
     return response($array,$status);
   }
 }
 