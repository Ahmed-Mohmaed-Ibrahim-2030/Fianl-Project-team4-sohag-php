<?php

namespace App\Http\Controllers;

use App\Models\Student_Exam;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student_ex =Student_Exam::all();
        return view('StudentExam.index',compact('student_ex'));
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
        Student_Exam::Create($request->all());
        return response('store  Student_Exam done ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student_Exam  $student_Exam
     * @return \Illuminate\Http\Response
     */
    public function show(Student_Exam $student_Exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student_Exam  $student_Exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student_ex =Student_Exam::findOrFail($id);
        return view('StudentExam.edit', compact('student_ex'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student_Exam  $student_Exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student_Exam $student_Exam,$id)
    {
        //
        $student_ex = Student_Exam::findOrFail($id);
        $student_ex -> update([
            'mark' => $request->mark,
            'student_id' => $request->student_id,
            'exam_id' => $request->exam_id,
        ]);
        return Redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student_Exam  $student_Exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Student_Exam::destroy($id);
        return Redirect();
    }
}
