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
        <div class="card-body">
    <form method="post" action="{{isset($qnumber)?route('admins.store'):""}}" enctype="multipart/form-data">
      {{  csrf_field()}}
      {{  method_field('post')}}

            <div class="form-group">
                <label for="exampleInputEmail1">Exam Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="exam_title" placeholder="" value="{{old('exam_title')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Exam Date</label>
                <input type="date" class="form-control" id="exampleInputEmail1" name="exam_date" placeholder="" value="{{old('exam_date')}}">
            </div>

                @if(isset($qnumber))
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Exam Questions</h3>
                </div>
                <div class="card-body" id="mainQuestions">




@for($i=1;$i<=$qnumber;$i++)
    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            </div>
                            <input type="text" class="form-control" placeholder="Question {{$i}}">
                            <span class="input-group-text">?</span>
                        </div>
                    <div class="row ">
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox">
                        </span>
                                </div>
                                <input type="text" class="form-control" placeholder="answer 1">
                            </div>
                            <!-- /input-group -->
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox">
                        </span>
                                </div>
                                <input type="text" class="form-control" placeholder="answer 2">
                            </div>
                            <!-- /input-group -->
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox">
                        </span>
                                </div>
                                <input type="text" class="form-control" placeholder="answer 3">
                            </div>
                            <!-- /input-group -->
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox">
                        </span>
                                </div>
                                <input type="text" class="form-control" placeholder="answer 4">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
                @endif
                <!-- /.card-body -->


    </form>
        @if(!isset($qnumber))
            <form method="get" action="{{route("exams.create")}}">
                <input type="number" name="qnumber" min="1" class="form-control w-25">
                <br>
                <button type="submit" class="btn btn-primary"> Questions count  </button>
            </form>
    @endif



    </div>
    @endsection
