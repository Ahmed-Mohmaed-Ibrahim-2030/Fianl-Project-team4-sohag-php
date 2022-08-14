<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/dist/img/logo/logo.jfif')}}" alt="E-L-Platform Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Education </span>
    </a>
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{Auth::user()->image?asset('assets/dist/img/user-images/'.Auth::user()->image):asset('assets/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"> {{Auth::user()->first_name .' '.Auth::user()->last_name}}</a>

        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            @if(Auth::user()->hasPermission('users-read'))
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Users
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('admins.index')}}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admins</p>
                        </a>
                    </li>
                                           <li class="nav-item">
                        <a href="{{route('students.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Students</p>
                        </a>
                    </li>
                                           <li class="nav-item">
                        <a href="{{route('parents.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Parents</p>
                        </a>
                    </li>
                                           <li class="nav-item">
                        <a href="{{route('instructors.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Instructors</p>
                        </a>
                    </li>

                        @if(Auth::user()->hasPermission('users-create'))
                    <li class="nav-item">
                        <a href="{{route('admins.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Admin</p>
                        </a>
                    </li>
                            @endif
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission('categories-read'))
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Categories
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('Category.index')}}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Categories</p>
                        </a>
                    </li>

                    @if(Auth::user()->hasPermission('categories-create'))
                    <li class="nav-item">
                        <a href="{{route('Category.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Category </p>
                        </a>
                    </li>

                    @endif
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission('courses-read'))
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Courses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('allcourses')}}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>list courses</p>
                            </a>
                        </li>


                        @if(Auth::user()->hasPermission('courses-update'))
                            <li class="nav-item">
                                <a href="{{route('UnreviewedCourses')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> unReviewed Courses </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                        @endif

            @if(Auth::user()->hasPermission('courses-update'))
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Exams
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('exams.index')}}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>list Exams</p>
                            </a>
                        </li>


                        @if(Auth::user()->hasRole('instructor'))
                            <li class="nav-item">
                                <a href="{{route('exams.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Add Exam </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                        @endif

            @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('super_admin'))
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Contact Us
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('contact-form')}}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contacts</p>
                            </a>
                        </li>



                    </ul>
                </li>
            @endif
                  </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
</aside>
