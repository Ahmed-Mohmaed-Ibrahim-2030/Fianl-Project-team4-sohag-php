@extends('layouts.adminDashboard')

@section('title')
List Exams
@endsection
@section('owner')
    Instructor
{{--    <small>{{$users->total()}}</small>--}}
    @endsection
@section('content')
    <form method="get" action="{{ 'exams' }}">
        <div class="form-group">
            <div class="row ">
                <div class="col-md-4">
                    <input type="search" name="search" class="form-control" value="{{request()->search}}" >
                </div>
                <div class="col-md-4">

                    <button type="submit" class="btn btn-outline-info btn-sm  {{Auth::user()->hasPermission('courses-read')?'':'disabled'}}"><i class="fa fa-search"></i> Find</button>
                    <a href="{{route('exams.create')}}" class="btn btn-outline-primary btn-sm  {{Auth::user()->hasRole('instructor')?'':'disabled'}}"><i class="fa fa-plus"></i> Add</a>
                </div>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">List all Admins</h3>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if($exams->count()>0)
            <table class="table table-hover text-nowrap ">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Time</th>
                    <th>Course</th>
                    <th>Add Questions</th>
                    <th style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($exams as $i=>$exam)
{{--{{dd($user)}}--}}
                <tr id="{{$exam->id}}">
                    <td>{{$i+1}}</td>
                    <td>{{$exam->exam_title }}</td>
                    <td>{{$exam->exam_date}}</td>
                    <td>{{\App\Models\Course::find($exam->course_id)->name}}</td>
                    <td>
                        <form method="get" action="{{route("exams.addQuestion",$exam)}}">
                                            <input type="number" name="qnumber" min="1" class="form-control d-inline-block w-25">

                                            <button type="submit" class="btn btn-primary"> <em class="fa fa-plus"></em>  </button>
                                        </form>
                    </td>


                    <td>
<a href="{{route('exams.edit',$exam->id)}}" class="btn btn-outline-warning {{Auth::user()->hasPermission('courses-update')?'':'disabled'}} " ><i class="fa fa-edit"></i> Edit</a>
<form method="post" action="{{route('exams.destroy',['exam'=>$exam])}}" id="delete-form" style="display:inline-block">
{{--<form method="post" action="{{route('admins.index')}}" >--}}
    {{csrf_field()}}
    {{method_field('delete')}}

                        <button type="submit"  class="btn btn-outline-danger delete " {{Auth::user()->hasRole('instructor')?'':'disabled'}}><i class="fa fa-trash"></i> Delete</button>
</form>
                    </td>
                </tr>
@endforeach
                </tbody>
            </table>
                {!! $exams->withQueryString()->links('pagination::bootstrap-5') !!}
            @else
                <h2>
                    No Exams Founded
                </h2>
            @endif
        </div>
        <!-- /.card-body -->
{{--        <div class="card-footer clearfix">--}}
{{--            <ul class="pagination pagination-sm m-0 float-right">--}}
{{--                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
    </div>

{{--      {{  $users->links()}}--}}
    @endsection
