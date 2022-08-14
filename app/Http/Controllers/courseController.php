<?php



namespace App\Http\Controllers;




use App\Http\Controllers\Controller;


use App\Models\Admin_Course;
use App\Models\Course;


use App\Models\Sub_Category;
use App\Models\User;
use App\Notifications\CreateCourse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->has("subCatID")){
            $courses = Course::where("sub_category_id",request()->get("subCatID"))->where('reviewed',true)->get();
        return view('courses.new.cources', ['courses' => $courses]);

        }
//            dd($cources);
        $courses = Course::where('reviewed',true)->get();
//        dd($cources);



        return view('AdminDashboard.Categories.SubCategories.Courses.courses', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //

        return view('AdminDashboard.Categories.SubCategories.Courses.create-course');



    }
public function getCourseBySubCategoryId(Sub_Category $subcategory){
    $courses=$subcategory->courses()->where('reviewed',true)->get();
    return view('AdminDashboard.Categories.SubCategories.Courses.courses', ['courses' => $courses]);
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
          'name'=>'required|min:3',
          'price'=>'required|min:1.00',
                'small_desc'=>'required',
                'description'=>'required|min:10',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
                'category_id'=>'required',
                'sub_category_id'=>'required',
//

            ]
        );

$request_data=$request->except('image' ,"_token");
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/dist/img/Course-images/'), $imageName);

            $request_data['image']=$imageName;

        }
//        dd($request_data);
        $course=Course::create($request_data);
        $user=User::where('id','!=',Auth::id())->get();
        // dd($course->id);
        // Notification::send($user , new CreateCourse($course->id));
        $created_by=Auth::user()->first_name;
        Notification::send($user , new CreateCourse($course->id,$created_by,$course->name));
        // return redirect()->route('/courses/create');

//        return redirect()->route('allcourses');
        return redirect()->route('UnreviewedCourses')->with('success','course added successfully but still not reviewd by admins');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course=Course::findorFail($id);
        $getId= DB::table('notifications')->where('data->course_id',$id)->pluck('id');
        DB::table('notifications')->where('id',$getId)->update(['read_at'=>now()]);
        return $course;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
        if($course->students()->count()){
            return back()->with('warning','there are students enroll in this course !');
        }
        else{
         $course->courseContent()->delete();
            $course->delete();
            return back()->with('success','deleted successfully !');
        }
    }
public function getUnreviewedCourse(){
    $courses = Course::where('reviewed',false)->get();
//        dd($cources);

    return view('AdminDashboard.Categories.SubCategories.Courses.unReviewed', compact('courses'));
}
public function review(Course $course){
Admin_Course::create([    'admin_id'=>Auth::user()->admin->id,
    'course_id'=>$course->id
    ]);
$course->update([
    'reviewed'=>true
]);
return redirect()->route('allcourses')->with('success','course  successfully  reviewd by admins');
}
}
