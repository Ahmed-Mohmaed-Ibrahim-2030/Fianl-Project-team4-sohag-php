<?php

namespace App\Http\Controllers\Api\login;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    //
    public function login(Request $request)
    {
if(Auth::attempt($request->only('email','password')))
{
$token=$request->user()->createToken('api');
return [
    'token'=>$token->plainTextToken];

}
    }
    public function registration(Request $request){

        try {
            //Validated
            $validateUser = Validator::make($request->all(),
                [
                    'first_name'=>'required',
                    'last_name' => 'required',
                    'username'=>'required|min:8',
                    'phone'=>'required|min:11|max:11',
                    'address'=>'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,

                'username' => $request->username,

                'password' => bcrypt($request->password)
            ]);
            $user->attachRole('student');
            $student=Student::create([
                'phone'=>$request->phone,
                'address'=>$request->address,
                'account_id'=>$user->id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
