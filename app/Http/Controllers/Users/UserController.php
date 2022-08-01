<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
   public function __construct(){
        $this->middleware(['permission:users-read'])->only('index');
        $this->middleware(['permission:users-create'])->only('create');
        $this->middleware(['permission:users-update'])->only('edit');
        $this->middleware(['permission:users-delete'])->only('delete');

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users =User::all();
        return view('AdminDashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminDashboard.users.create');
        //
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


  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string',  'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:admins'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

            $request_data=$request->except('password','password_confirmation','permissions');

            $request_data['password']=bcrypt($request->password);
        $user=User::create([

            'email'=>$request->email,
                'username'=>$request->username,
                'password'=>bcrypt($request->password),
                'role'=>'admin'
            ]
        );
        Admin::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'account_id'=>$user->id
        ]);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {


        return view('AdminDashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        $request->validate([
            'name' => [ 'string', 'max:255'],
//
            'email' => [ 'string', 'email', 'max:255',  'unique:users,email,'.$user->id],

            'phone' => ['string', 'max:11','unique:users,phone,'.$user->id],

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $request_data=$request->only('email');
        if($request->hasFile('image')){
        $imageName = time().'.'.$request->image->extension();
//            $removedPhotoPath = public_path("assets/dist/img/user-images/{$user->image}");
//            \App\Http\Services\Media::delete($removedPhotoPath);
        $request->image->move(public_path('assets/dist/img/user-images/'), $imageName);
        $request_data['image']=$imageName;

        }

//dd($request_data);
$user->update(
    $request_data
);
        Admin::where('account_id', $user->id)->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
        ]);
        $user->syncPermissions($request->permissions);
return redirect()->route('users.edit',$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
    public static function  userInfo ()
    {
        switch (Auth::user()->role) {

            case 'instructor':
                  return User::find(Auth::id())->join('instructors','users.id','=','instructors.account_id')->select('users.*','instructors.*')->first();
            case 'parent':
                return User::find(Auth::id())->join('parents','users.id','=','parents.account_id')->select('users.*','parents.*')->first();
            case 'student':
                return User::find(Auth::id())->join('students','users.id','=','students.account_id')->select('users.*','students.*')->first();
            default:
                return   User::find(Auth::id())->join('admins','users.id','=','admins.account_id')->select('users.*','admins.*')->first();


}

    }
}
