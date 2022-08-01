<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents =DB:: table('parents')-> get();
        return view('parents.index',compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        DB::table('parents')->insert([
            'id'=> $request ->id ,
            'first_name'=> $request -> first_name ,
            'last_name'=> $request -> last_name,
            'account_id'=> $request ->account_id,
            
        ]);
        return response('parents inserted successfully');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parents= DB::table('parents')->where ('id',$id)->first();
        return view('parents.edit',compact('parents'));
        
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
        DB::table('parents')->updated([
            'id'=> $request ->id ,
            'first_name'=> $request -> first_name ,
            'last_name'=> $request -> last_name,
            'account_id'=> $request ->account_id,
            
        ]);
        return response('parents updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $parents= DB::table('parents')->where ('id',$id)->delete();
    }
}
