<?php

namespace App\Http\Controllers;

use App\Models\offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offer= offer::all();
        return $offer;
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
        offer::create([
        'discount_type'=>$request->discount_type,
        'discount_value'=>$request->discount_value,
        'title'=>$request->title,
        'announce_date'=>$request->announce_date,
        'start_date'=>$request->start_date,
        'end_date'=>$request->end_date,
        'course_id'=>$request->course_id,
        'admin_id'=>$request->admin_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = offer::findorFail($id);
        return $offer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $offer = offer::findorFail($id);
        $offer->update([
            $offer=>$request->discount_type,
            $offer=>$request->discount_value,
            $offer=>$request->title,
            $offer=>$request->announce_date,
            $offer=>$request->start_date,
            $offer=>$request->end_date,
            $offer=>$request->course_id,
            $offer=>$request->admin_id
        ]);
        return redirect()->route('offer.index',compact($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        offer::findorFail($id)->delete();
        return redirect()->route('offer.index');
    }
}
