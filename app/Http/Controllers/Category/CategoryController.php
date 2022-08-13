<?php


namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;


//namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
//        $categories=Category::all();
//        return view('adminDashboard.Categories.index',compact('categories'));
        $categories = Category::where(function($query) use ($request){
            return $query->when($request->search,function($q)use ($request){
                return $q->where('name','like','%'.$request->search.'%');
            });
        })->get();





        return view('adminDashboard.Categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Categories.create
        return view('AdminDashboard.Categories.create');
    }
    public function getSubCategories(Category $category,Request $request){

//$subCategories=$category->subcategory;
        $subCategories =$category->subcategory()->where(function($query) use ($request){
            return $query->when($request->search,function($q)use ($request){
                return $q->where('name','like','%'.$request->search.'%');
            });
        })->get();
        return view('AdminDashboard.Categories.SubCategories.index',compact('subCategories','category'));
    }
public function createSubCategory(Category $category){
        return view('AdminDashboard.Categories.create',compact('category'));
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate( [
            'name'=>'required|min:3',
            'slug'=>'required|min:5|unique:categories',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
//        $image = $request->image;
//        $input['file'] = time().'.'.$image->getClientOriginalExtension();
//
//        $destinationPath = public_path('/assets/dist/img/Category-images');
//        $imgFile = Image::make($image->getRealPath());
//        $imgFile->resize(150, 150, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($destinationPath.'/'.$input['file']);
//        $destinationPath = public_path('/uploads');
//        $image->move($destinationPath, $input['file']);
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/dist/img/Category-images/'), $imageName);


        }
        Category::create([
           'name'=>$request->name,
           'slug'=>$request->slug,
           'image'=>$imageName,
        ]);

    return redirect()->route('Category.index');
    }
    public function storeSubCategory(Category $category,Request $request){
        $request->validate( [
            'name'=>'required|min:3',

            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/dist/img/SubCategory-images/'), $imageName);


        }
        $category->subcategory()->create([
            'name'=>$request->name,

            'image'=>$imageName,
        ]);
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
    public function edit(Category $Category)
    {
        //
        return  view('AdminDashboard.Categories.edit',compact('Category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $Category)
    {
        //
        $request->validate( [
            'name'=>'min:3',
            'slug'=>'required|min:5|unique:categories,slug,'.$Category->id,
            'image' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        $request_data=$request->except('image');
//        $image = $request->image;
//        $input['file'] = time().'.'.$image->getClientOriginalExtension();
//
//        $destinationPath = public_path('/assets/dist/img/Category-images');
//        $imgFile = Image::make($image->getRealPath());
//        $imgFile->resize(150, 150, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($destinationPath.'/'.$input['file']);
//        $destinationPath = public_path('/uploads');
//        $image->move($destinationPath, $input['file']);
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/dist/img/Category-images/'), $imageName);
$request_data['image']=$imageName;

        }
        $Category->update($request_data);

        return redirect()->route('Category.edit',$Category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Category $Category)
    {
        //

        if($Category->subcategory()->count() > 0)
        {
            return back()->with('warning','can not delete this cat because it has childs !');
        }
        else{
            $Category->delete();
            return back()->with('succces','this cat  delete successfully !');
        }
//        return redirect()->back();
    }
}
