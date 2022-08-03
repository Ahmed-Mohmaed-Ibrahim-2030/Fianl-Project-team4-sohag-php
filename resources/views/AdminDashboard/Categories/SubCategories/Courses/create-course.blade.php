@extends('layouts.AdminDashboard')
@section('title')
    New Course
@endsection
@section('owner')
    Courses
@endsection
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>

        <div class="col-md-12 mb-3">
            <strong>Grayscale Image:</strong><br/>
            <img src="/uploads/{{ Session::get('fileName') }}" width="550px" />
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">New Course</h3>
                    </div>
                <form role="form" class="form-horizontal p-3" method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">

                            <div class="">
                                <div class="form-group">
                                    <label>course name*</label>
                                    <input type="text" name="name" class="form-control" placeholder="course name" value="{{old('name')}}" required />
                                </div>
                            </div>
                           <div class="form-group">
                                    <label>course price*</label>
                                    <input type="number" name="price" min="1"  class="form-control" placeholder="price" value="{{old('price')}}" required />
                                </div>
                            </div>

                            <div class="form-group">
                                    <label>course short description*</label>
                                    <input type="text" name="small_desc" class="form-control" placeholder="course short description" value="{{old('small_desc')}}" required />
                                </div>
                                <div class="form-group">
                                    <label>course  description*</label>
                                    <input type="text" name="description" class="form-control" placeholder="course  description" value="{{old('description')}}" required />
                                </div>
                    <div class="form-group ml-3">

                        <label for="user_image" class="form-label">
                            <img style="width:200px;height:200px;" src="{{asset('assets/dist/img/avatar5.png')}}" class="img-thumbnail image-preview">
                        </label>
                        <input id="user_image" type="file" class="image" name="image" hidden>
                    </div>
                            <div class="form-group">
                            <label for="course">Select category course</label>

                            <select class="form-control" id="category_id" name="category_id" >
                            <option value="" selected disabled hidden>Choose here</option>
                            @php
                                $Categories = \App\Models\Category::all();
                            @endphp
                                @foreach ($Categories as $Categorie)
                                    <option value="{{ $Categorie->id }}" {{old(
                                'category_id')==$Categorie->id?"selected":""}}>{{ $Categorie->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course">Select subcategory course</label>

                            <select class="form-control" id="sub_category_id" name="sub_category_id" >
                            <option value="" selected disabled hidden>Choose here</option>
                            @php
                                $SubCategories = \App\Models\Sub_Category::all();
                            @endphp
                                @foreach ($SubCategories as $subCategorie)
                                    <option value="{{$subCategorie->id}}" {{old('sub_category_id')==$subCategorie->id?"selected":""}}>{{ $subCategorie->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="course">Select Instructor course</label>

                            <select class="form-control" id="instructor_id" name="instructor_id" >
                            <option value="" selected disabled hidden>Choose here</option>
                            @php
                                $Instructors = \App\Models\Instructor::all();
                            @endphp
                                @foreach ($Instructors as $Instructor)
                                    <option value="{{ $Instructor->id }} {{old('instructor_id')==$Instructor->id?"selected":""}}">{{ \App\Models\User::find($Instructor->account_id)->username }}</option>
                                @endforeach
                            </select>
                        </div>



                </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Create</button>

                    </div>
                </form>



    @endsection
