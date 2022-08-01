<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<section class="content" style="padding:20px 30%;">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Create course</h3>
                </div>
                
                <form role="form" method="POST" action="{{ route('course.store') }}">
                    {{csrf_field()}}
                    <div class="box-body">
                       
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>course name*</label>
                                    <input type="text" name="name" class="form-control" placeholder="course name" value="{{old('name')}}" required />
                                </div>
                            </div>
                           <div class="form-group">
                                    <label>course price*</label>
                                    <input type="number" name="price" class="form-control" placeholder="course name" value="{{old('name')}}" required />
                                </div>
                            </div>

                            <div class="form-group">
                                    <label>course short description*</label>
                                    <input type="text" name="samall_desc" class="form-control" placeholder="course short description" value="{{old('name')}}" required />
                                </div>
                                <div class="form-group">
                                    <label>course  description*</label>
                                    <input type="text" name="description" class="form-control" placeholder="course  description" value="{{old('name')}}" required />
                                </div>
                            <div class="form-group">
                            <label for="course">Select category course</label>
                         
                            <select class="form-control" id="category_id" name="category_id" >
                            <option value="" selected disabled hidden>Choose here</option>
                            @php
                                $Categories = \App\Models\Category::all();
                            @endphp
                                @foreach ($Categories as $Categorie)
                                    <option value="{{ $Categorie->id }}">{{ $Categorie->name }}</option>
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
                                    <option value="{{ $subCategorie->id }}">{{ $subCategorie->name }}</option>
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
                                    <option value="{{ $Instructor->id }}">{{ $Instructor->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course">accepted by</label>
                         
                            <select class="form-control" id="accepted-by" name="accepted-by" >
                            <option value="" selected disabled hidden>Choose here</option>
                            @php
                                $admins = \App\Models\Admin::all();
                            @endphp
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>
                         

                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Create</button>

                    </div>
                </form>

                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                @if(\Session::has('error'))
                    <div>
                        <li class="alert alert-danger">{!! \Session::get('error') !!}</li>
                    </div>
                @endif

                @if(\Session::has('success'))
                    <div>
                        <li class="alert alert-success">{!! \Session::get('success') !!}</li>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>