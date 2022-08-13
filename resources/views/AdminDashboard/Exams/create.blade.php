@extends('layouts.AdminDashboard')
@section('title')
   add exam
    @endsection
@section('owner')
    Instructor
    @endsection
<?php
$models=['users','categories','subCategories','courses'];
$maps=['primary'=>['create','plus'],'info'=>['read','book'],'warning'=>['update','edit'],'danger'=>['delete','']];
?>
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Exam</h3>
        </div>
        @foreach($errors->all() as $error)
            <div class="alert mt-2 alert-danger">
                {{$error}}
            </div>
        @endforeach

                @if(isset($qnumber))
            <div class="card-body">
                <form method="post" action="{{isset($qnumber)?route('exams.store'):""}}" enctype="multipart/form-data">
                    {{  csrf_field()}}
                    {{  method_field('post')}}

                    <div class="form-group">
                        <label for="exampleInputEmail1">Exam Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="exam_title" placeholder="" value="{{old('exam_title')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Exam Date</label>
                        <input type="datetime-local" class="form-control" id="exampleInputEmail1" name="exam_date" placeholder="" value="{{old('exam_date')}}">
                    </div>
                    @if(Auth::user()->instructor)
                        <div class="form-group">
                            <label for="exampleInputEmail1">Course</label>

                            <select class="form-select form-control" name ='course_id' aria-label="Default select example">
                                @foreach(Auth::user()->instructor()->join('courses','instructors.id','courses.instructor_id')->select('courses.id','courses.name')->get() as $course)
                                    <option value="{{$course->id}}">{{$course->name}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Exam Questions</h3>
                </div>
                <div class="card-body" id="mainQuestions">




@for($i=1;$i<=$qnumber;$i++)
    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span  class="input-group-text bg-light" >Q {{$i}}</span>
                            </div>
                            <input type="text"  name="question[]" class="form-control" placeholder="Question {{$i}}">
                         <input type="hidden" name="answer_number[]" value="{{$i}}">
                            <input type="hidden" name="value[]" value="10"  >
                            <div class="input-group-append">
                            <span class="input-group-text">?</span>
                            </div>
                        </div>
                    <div class="row ">
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input name="is_correct[]" value="1" type="checkbox">
                        </span>
                                </div>
                                <input type="text"  name="option[]" class="form-control" placeholder="answer 1">
                            </div>
                            <!-- /input-group -->
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                        <input name="is_correct[]" value="2" type="checkbox">
                        </span>
                                </div>
                                <input type="text"  name="option[]" class="form-control" placeholder="answer 2">
                            </div>
                            <!-- /input-group -->
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                        <input name="is_correct[]" value="3" type="checkbox">
                        </span>
                                </div>
                                <input type="text" name="option[]" class="form-control" placeholder="answer 3">
                            </div>
                            <!-- /input-group -->
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                         <input name="is_correct[]" value="4" type="checkbox">
                        </span>
                                </div>
                                <input type="text" name="option[]" class="form-control" placeholder="answer 4">
                            </div>
                            <!-- /input-group -->
                        </div>

                        <!-- /.col-lg-6 -->
                    </div>
    </div>
                    @endfor
                    <!-- /.row -->


                    <!-- /input-group -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" {{Auth::user()->hasRole('instructor')?'':'disabled'}}>Submit</button>
                </div>
            </div>
                @endif
                <!-- /.card-body -->


    </form>
        @if(!isset($qnumber))
            <form class="ml-4" method="get" action="{{route("exams.create")}}">
             <div class="form-group">
                 <label for="exampleInputEmail1">Number of Questions</label>
                 <input type="number" name="qnumber" min="1" class="form-control w-25">
             </div>
            <div class="form-group">

                <button type="submit" class="btn btn-primary"> Questions count  </button>
            </div>
            </form>
    @endif



    </div>
    @endsection
