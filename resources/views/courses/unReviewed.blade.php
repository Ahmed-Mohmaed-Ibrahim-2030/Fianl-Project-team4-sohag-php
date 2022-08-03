@extends('layouts.adminDashboard')

@section('title')
List Users
    @endsection
@section('owner')
    Admins
{{--    <small>{{$users->total()}}</small>--}}
    @endsection
@section('content')
{{--    <form method="get" action="{{ 'admins' }}">--}}
{{--        <div class="form-group">--}}
{{--            <div class="row ">--}}
{{--                <div class="col-md-4">--}}
{{--                    <input type="search" name="search" class="form-control" value="{{request()->search}}" >--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}

{{--                    <button type="submit" class="btn btn-outline-info btn-sm  {{Auth::user()->hasPermission('users-read')?'':'disabled'}}"><i class="fa fa-search"></i> Find</button>--}}
{{--                    <a href="{{route('admins.create')}}" class="btn btn-outline-primary btn-sm  {{Auth::user()->hasPermission('users-create')?'':'disabled'}}"><i class="fa fa-plus"></i> Add</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
    <div class="card">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">List all Admins</h3>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if($courses->count()>0 or !Auth::user()->hasRole('admin'))
            <table class="table table-hover text-nowrap ">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Eamil</th>
                    <th style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $i=>$course)
{{--{{dd($course)}}--}}
                <tr id="{{$course->id}}">
                    <td>{{$i+1}}</td>
                    <td>{{$course->name }}</td>
                    <td>{{$course->small_desc}}</td>

                    <td>
<a href="{{route('review',$course->id)}}" class="btn btn-outline-warning {{Auth::user()->hasPermission('courses-update')?'':'disabled'}} " ><i class="fa fa-edit"></i> Edit</a>
<form method="post" action="{{route('courses.destroy',['course'=>$course])}}" id="delete-form" style="display:inline-block">
{{--<form method="post" action="{{route('admins.index')}}" >--}}
    {{csrf_field()}}
    {{method_field('delete')}}

                        <button type="submit"  class="btn btn-outline-danger delete " {{Auth::user()->hasPermission('course-delete')?'':'disabled'}}><i class="fa fa-trash"></i> Delete</button>
</form>
                    </td>
                </tr>
@endforeach
                </tbody>
            </table>
            @else
                <h2>
                    No Users Founded
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

{{--      {{  $courses->links()}}--}}
    @endsection
