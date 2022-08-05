@extends("layouts.adminDashboard")
@section('title')
    Show Courses

@endsection
@section('owner')
    Courses
@endsection

@section('content')

    <form method="get" action="{{ 'admins' }}">
        <div class="form-group">
            <div class="row ">
                <div class="col-md-4">
                    <input type="search" name="search" class="form-control" value="{{request()->search}}" >
                </div>
                <div class="col-md-4">

                    <button type="submit" class="btn btn-outline-info btn-sm  {{Auth::user()->hasPermission('courses-read')?'':'disabled'}}"><i class="fa fa-search"></i> Find</button>
                    <a href="{{ route('create.course')}}" class="btn btn-outline-primary btn-sm  {{Auth::user()->hasPermission('courses-create')?'':'disabled'}}"><i class="fa fa-plus"></i> Add</a>
                </div>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">List Courses </h3>
            </div>

            <!-- /.card-body -->
        </div>
{{--<a href="{{ route('create.course')}}" class="btn btn-primary">add new cource</a>--}}
        @if($courses->count()>0)
{{--<table class="table">--}}
{{--  <thead>--}}
{{--    <tr>--}}
{{--      <th scope="col">#</th>--}}
{{--      <th scope="col">name</th>--}}
{{--        <th scope="col"> Image </th>--}}
{{--      <th scope="col">add videos</th>--}}
{{--      <th scope="col">view videos</th>--}}


{{--    </tr>--}}
{{--  </thead>--}}
{{--  <tbody>--}}
{{--  {{dd($courses)}}--}}
        <div class="row row-cols-lg-4 row-cols-md-2 px-1">
@foreach ($courses as $course)
{{--  <tr>--}}

{{--      <th scope="row"> {{$course->id}}</th>--}}
{{--      <td> {{$course->name}}</td>--}}
{{--      <td> <a href="{{ route('course.video.create',$course)}}" class="btn btn-primary">add video</a></td>--}}
{{--      <td> <a href="{{ route('course.video.show',$course)}}" class="btn btn-primary">view video</a></td>--}}
{{--      </tr>--}}
            <div class="col">


                <div class="card " >
      <a href="{{ route('course.video.show',$course)}}">
          <img src="{{asset('assets/dist/img/Course-images/'.$course->image)}}" class="card-img-top" alt="...">
      </a>
      <div class="card-body">
          <a class="btn btn-outline-warning border-none" href="{{ route('course.video.show',$course)}}">
          <h5 class="card-title">{{$course->name}}</h5>
          </a>
          <p class="card-text">{{$course->description}}</p>
          <a href="{{ route('course.video.create',$course)}}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> add Content </a>
      </div>
    </div>
            </div>
@endforeach
        </div>

{{--    </tbody>--}}
{{--</table>--}}

        @else
            <h3 class="alert alert-warning mx-2">
                Now Videos Added Yet
            </h3>
    @endif
@endsection
