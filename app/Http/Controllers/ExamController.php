<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->search)
        {
            if(Auth::user()->admin)
            { $exams =Exam::where('exam_title','like',"%$request->search%")->paginate(4);
                return view('AdminDashboard.Exams.index',compact('exams'));

            }
            elseif (Auth::user()->instructor)
            {
                $exams= Auth::user()->instructor()->join('courses','instructors.id','courses.instructor_id')->join('exams','courses.id','exams.course_id')->where('exams.exam_title','like',"%$request->search%")->select('exams.*')->paginate(4);
//     dd($exams);
                return view('AdminDashboard.Exams.index',compact('exams'));

            }
        }
        else
        {
 if(Auth::user()->admin)
 { $exams =Exam::paginate(4);
        return view('AdminDashboard.Exams.index',compact('exams'));

 }
 elseif (Auth::user()->instructor)
 {
    $exams= Auth::user()->instructor()->join('courses','instructors.id','courses.instructor_id')->join('exams','courses.id','exams.course_id')->select('exams.*')->paginate(4);
//     dd($exams);
        return view('AdminDashboard.Exams.index',compact('exams'));

 }
        }
    }
public function questionsCount(Request $request){


}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if ($request->qnumber)
        return view('AdminDashboard.Exams.create',['qnumber' => $request->qnumber]);
        else
        return view('AdminDashboard.Exams.create');
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
//        dd($request->all());
$questions=[];

foreach($request->all()['question'] as $i=>$question )
{
    $index =$i*4;
    $questions[$i]=[
        'question'=>$question,
        'answer_number'=>$request->answer_number[$i],
        'value'=>$request->value[$i],
        'options'=>[
             [
                  "option"=> $request->option[$index],
          "is_correct"=>$request->is_correct[$i]==1?true:false,
        ],
         [
                  "option"=> $request->option[$index+1],
          "is_correct"=>$request->is_correct[$i]==2?true:false,
        ],
            [
                  "option"=> $request->option[$index+2],
          "is_correct"=>$request->is_correct[$i]==3?true:false,
        ],
            [
                  "option"=> $request->option[$index+3],
          "is_correct"=>$request->is_correct[$i]==4?true:false,
        ],
]
    ];

}
//dd($questions);

//        Exam::Create($request->all());
//        return response('store  Student done ');
        $exam = Exam::create([
            'exam_date' => $request->exam_date,
            'exam_title' => $request->exam_title,
            'course_id' => $request->course_id,
        ]);
        $exam->questions()->createMany( (array) $questions);
        return redirect()->route('exams.index' ,$exam)->with('success','exam added  successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $exam =Exam::findOrFail($id);
        return view('AdminDashboard.Exams.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, Exam $exam,$id)
//    {
//        //
//        $exam = Exam::findOrFail($id);
//        $exam -> update([
//            'exam_id' => $request->exam_id,
//            'announce_date' => $request->announce_date,
//            'start_date' => $request->start_date,
//            'hours' => $request->hours,
//            'mark' => $request->mark,
//            'course_id' => $request->course_id,
//        ]);
//        return Redirect();
//    }
    public function update(Request $request, Exam $exam)
    {
        //
        $questions=[];

        foreach($request->all()['question'] as $i=>$question )
        {
            $index =$i*4;
            $questions[$i]=[
                'question'=>$question,
                'answer_number'=>$request->answer_number[$i],
                'value'=>$request->value[$i],
                'options'=>[
                    [
                        "option"=> $request->option[$index],
                        "is_correct"=>$request->is_correct[$i]==1?true:false,
                    ],
                    [
                        "option"=> $request->option[$index+1],
                        "is_correct"=>$request->is_correct[$i]==2?true:false,
                    ],
                    [
                        "option"=> $request->option[$index+2],
                        "is_correct"=>$request->is_correct[$i]==3?true:false,
                    ],
                    [
                        "option"=> $request->option[$index+3],
                        "is_correct"=>$request->is_correct[$i]==4?true:false,
                    ],
                ]
            ];

        }
        $exam->update([

            'exam_date' => $request->exam_date,
            'exam_title' => $request->exam_title,
            'course_id' => $request->course_id,
        ]);
        $exam->questions()->delete();

        $exam->questions()->createMany( (array) $questions);
        return back()->with('success','exam updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->questions()->delete();
        $exam->delete();
        return redirect()->route('exams.index' ,$exam)->with('success','exam deleted  successfully!');
    }
    public function storeQuestion(Request $request,Exam $exam){
        $questions=[];

        foreach($request->all()['question'] as $i=>$question )
        {
            $index =$i*4;
            $questions[$i]=[
                'question'=>$question,
                'answer_number'=>$request->answer_number[$i],
                'value'=>$request->value[$i],
                'options'=>[
                    [
                        "option"=> $request->option[$index],
                        "is_correct"=>$request->is_correct[$i]==1?true:false,
                    ],
                    [
                        "option"=> $request->option[$index+1],
                        "is_correct"=>$request->is_correct[$i]==2?true:false,
                    ],
                    [
                        "option"=> $request->option[$index+2],
                        "is_correct"=>$request->is_correct[$i]==3?true:false,
                    ],
                    [
                        "option"=> $request->option[$index+3],
                        "is_correct"=>$request->is_correct[$i]==4?true:false,
                    ],
                ]
            ];

        }

        $exam->questions()->createMany( (array) $questions);
        return redirect()->route('exams.edit' ,$exam)->with('success','Questions added successfully!');



    }
    public function addQuestion(Request $request,Exam $exam){
        if ($request->qnumber)
        return view('AdminDashboard.Exams.addQuestions', ['exam' => $exam,'qnumber'=>$request->qnumber]);
        else
        {
            return back()->with('warning','please enter Questions Count!');
        }
    }
    public function destroyQuestion( $question){
//        dd($question);
//        $question->delete();
        Question::findOrFail($question)->delete();
        return back()->with('success','Question delete successfully!');
    }
}
