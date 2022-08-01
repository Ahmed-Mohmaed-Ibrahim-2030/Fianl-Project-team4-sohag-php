<?php
namespace app\Http\Controllers\Api;
 /**
  * 
  */
 trait ApiResponseOfferTrait
 {
   public function ApiResponseOffer($data=null , $message=null ,$status=null){
    $array =[
        'data'=>$data,
        'message'=>$message,
        'status'=>$status
     ];
     return response($array,$status);
   }
 }
 