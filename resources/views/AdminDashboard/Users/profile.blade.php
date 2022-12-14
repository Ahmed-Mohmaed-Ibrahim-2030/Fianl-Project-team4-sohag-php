@extends('layouts.adminDashboard')

@section('title')
 Profile
@endsection
@section('owner')
    Users
@endsection
@section('content')
<div class="">

    <?php
   $user=Illuminate\Support\Facades\Auth::user();
   //$//user =App\Http\Controllers\Users\UserController::userInfo();
//dd($user);
    ?>
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{$user->first_name .' '. $user->last_name}}</h3>
            <h5 class="widget-user-desc">{{$user->role}}</h5>
        </div>
        <div class="widget-user-image">

            <img class="img-circle elevation-2" src="{{$user->image?asset('assets/dist/img/user-images/'.$user->image):asset('assets/dist/img/avatar5.png')}}">
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">35</h5>
                        <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>

        </div>
        <div class="text-center py-3 bg-dark">
            <a href="{{route('users.edit',['user'=>$user->id])}}" class="btn btn-outline-warning {{Auth::user()->hasPermission('users-update')?'':'disabled'}} " ><i class="fa fa-edit"> </i> Edit</a>
            <form method="post" action="{{route('users.destroy',['user'=>$user])}}" style="display:inline-block">
                {{csrf_field()}}
                {{method_field('delete')}}

                <button type="submit"  class="btn btn-outline-danger " {{Auth::user()->hasPermission('users-delete')?'':'disabled'}}><i class="fa fa-trash"></i>Delete</button>
            </form>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.widget-user -->
</div>
@endsection
