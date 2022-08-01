<?php

namespace App\Http\Controllers\Api\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\offer;
use Illuminate\Support\Facades\Validator;

class offerController extends Controller
{
    use ApiResponseOfferTrait;

    public function index()
    {
        $offers = offerResource::collection(offer::get()) ;
        return $this->ApiResponseOffer($offers , 200);
    }
    
    public function show($id)
    {
        $offer = new offerResource(offer::findorFail($id));
        if($offer){
            return $this->ApiResponseOffer($offer , 200);
        }
        return $this->ApiResponseOffer(null , 'course content not found' , 404);

    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_type'=> 'required',
            'discount_value'=> 'required',
            'title'=> 'required',
            'announce_date'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'course_id'=> 'required',
            'admin_id'=> 'required'
        ]);
        if ($validator->fails()) {
            return $this->ApiResponseOffer(null ,$validator->errors(), 400);
        }

        $offer= offer::create($request->all());
        if($offer){
            return $this->ApiResponseOffer($offer , 201);
        }
        return $this->ApiResponseOffer(null , 'course content not saved' , 400);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_type'=> 'required',
            'discount_value'=> 'required',
            'title'=> 'required',
            'announce_date'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'course_id'=> 'required',
            'admin_id'=> 'required'
        ]);

        if ($validator->fails()) { return $this->ApiResponseOffer(null ,$validator->errors(), 400); }

        $offer = offer::find($id);
        if(!$offer) {  return $this->ApiResponseOffer(null , 'course content not found' , 404);}
        $offer->update($request->all());
        if($offer) {  return $this->ApiResponseOffer($offer ,'course content updated successfully', 201);}
    }


    public function destroy($id)
    {
        $offer = offer::find($id);
        if(!$offer) {
            return $this->ApiResponseOffer(null , 'course content not found' , 404);
        }
        $offer->delete($id);
        if($offer) {  
            return $this->ApiResponseOffer(null ,'course content deleted', 200);
        }

    }
}
