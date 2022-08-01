<?php

namespace App\Http\Controllers;

use App\Models\Exam_Content;
use Illuminate\Http\Request;

class ExamContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $exam_content =Exam_Content::all();
        return view('examContetn.index',compact('student'));
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
        Exam_Content::Create($request->all());
        return response('store Exam_Content done ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam_Content  $exam_Content
     * @return \Illuminate\Http\Response
     */
    public function show(Exam_Content $exam_Content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam_Content  $exam_Content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $exam_content =Exam_Content::findOrFail($id);
        return view('examContetn.edit', compact('exam_content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam_Content  $exam_Content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam_Content $exam_Content,$id)
    {
        //
        $exam_content = Exam_Content::findOrFail($id);
        $exam_content -> update([
            'exam_content_id' => $request->exam_content_id,
            'question_source' => $request->question_source,
            'exam_type' => $request->exam_type,
            'exam_id' => $request->exam_id,
        ]);
        return Redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam_Content  $exam_Content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Exam_Content::destroy($id);
        return Redirect();
    }
}
