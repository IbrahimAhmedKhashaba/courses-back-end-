<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
class AuthController extends Controller
{
    //

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|email|unique:users,email|max:100",
            "phone"=>"required|min:11",
            "password"=>"required|string|min:6|confirmed",
            "role"=>"",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "password"=> Hash::make($request->password),
            "role"=>$request->role ?? 'user',
        ]);       

            return response()->json([
                "message"=>"Created successfully",
            ], 200);
    }

    public function login(Request $request){
            $user = User::where('email' , '=' , $request->email)->first();
            if(! $user){
                return "not found email";
            } else if(Hash::check($request->password , $user->password)){
                Auth::loginUsingId($user->id);
                if (Auth::check()) {
                    $token = Str::random(64);
                    User::where('id',$user->id)->update([
                        'remember_token' =>  $token,
                    ]);
                    return response()->json([
                        "message"=>"login successfully",
                        
                        "data"=>[
                            "token"=>$token,
                            "id"=>$user->id,
                            "role"=>$user->role,
                        ],
                    ], 200);
                }else{

                    return response()->json([
                        "message"=> "not meet",
                    ] , 403);
                }
            } else {
                return response()->json([
                    "message"=> "cordinats errors",
                ] , 402);
            }

    }

    public function logout(Request $request){
        User::where('remember_token',$request->remember_token)->update([
            'remember_token' =>  null,
        ]);
        Auth::logout();
        return response()->json([
            "message"=> "success logout",
        ] , 200);
    }

    

    
}
