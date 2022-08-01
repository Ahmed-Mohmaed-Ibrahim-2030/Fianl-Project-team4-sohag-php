<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InstructorsSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors_support =DB:: table('instructors_support')-> get();
        return view('instructors_support.index',compact('instructors_support'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructors_support.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        DB::table('instructors_support')->insert([
            'id'=> $request ->id ,
            'support'=> $request ->support,
            'instructor_id'=> $request ->instructor_id ,
            'admin_id'=> $request ->admin_id,
           
        ]);
        return response('instructors_support inserted successfully');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins= DB::table('instructors_support')->where ('id',$id)->first();
        return view('instructors_support.edit',compact('instructors_support'));
        
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
        DB::table('instructors_support')->updated([
            'id'=> $request ->id ,
            'support'=> $request ->support,
            'instructor_id'=> $request ->instructor_id ,
            'admin_id'=> $request ->admin_id,
           
        ]);
        return response('instructors_support updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $instructors_support= DB::table('instructors_support')->where ('id',$id)->delete();
        
    }
}
