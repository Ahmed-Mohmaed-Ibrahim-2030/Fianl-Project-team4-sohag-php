<?php

namespace App\Http\Controllers;

use App\Models\Student_Support;
use Illuminate\Http\Request;

class StudentSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student_support =Student_Support::all();
        return view('StudentsSupport.index',compact('student_support'));
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
        //
        StudentSupportController::Create($request->all());
        return response('store StudentSupportController done ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student_Support  $student_Support
     * @return \Illuminate\Http\Response
     */
    public function show(Student_Support $student_Support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student_Support  $student_Support
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student_support =Student_Support::findOrFail($id);
        return view('StudentsSupport.edit', compact('student_support'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student_Support  $student_Support
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student_Support $student_Support,$id)
    {
        //
        $student = Student_Support::findOrFail($id);
        $student -> update([
            'support' => $request->support,
            'admin_id' => $request->admin_id,
            'student_id' => $request->student_id
        ]);
        return Redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student_Support  $student_Support
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Student_Support::destroy($id);
        return Redirect();
    }
}
