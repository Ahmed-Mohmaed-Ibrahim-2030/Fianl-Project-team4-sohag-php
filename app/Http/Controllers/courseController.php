<?php



namespace App\Http\Controllers;




use App\Http\Controllers\Controller;

namespace App\Http\Controllers;


use App\Models\Course;


use Illuminate\Http\Request;

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
            $cources = Course::where("sub_category_id",request()->get("subCatID"))->get();
        return view('courses.new.cources', ['cources' => $cources]);

        }
        $cources = Course::all();



        return view('courses.new.cources', ['cources' => $cources]);
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

        return view('courses.new.create-course',);

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
                'accepted_by'=>'required'

            ]
        );

$request_data=$request->except('image' ,"_token");
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/dist/img/SubCategory-images/'), $imageName);

            $request_data['image']=$imageName;

        }
//        dd($request_data);
        Course::create($request_data);
        return redirect()->route('allcourses');
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
        //
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
    public function destroy($id)
    {
        //
    }
}
