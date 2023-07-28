<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function all(){
        $users = User::with('courses')->get();
        return response()->json([
            "message"=>"users data",
            "data"=>$users
        ] , 200);
    }

    public function profile(Request $request){
        $remember_token = $request->remember_token;
        $user = User::with('courses')->where('remember_token' , '=' , $remember_token)->get();
        return response()->json([
            "message"=>"user data",
            "data"=>$user
        ] , 200);
    }

    public function add_course(Request $request , $id){
        $user = User::find($id);
        $flag = false;
        foreach($user->courses as $course){
            if ($course->id == $request->course_id) {
                $flag = true;
                break;
            }	
        }
        if (!$flag ){
            $user->courses()->attach($request->course_id);
            return response()->json([
            "message"=>"Added success",
            
            ] , 200);
        } else {
            return response()->json([
                "message"=>"Already exist",
            ] , 200);
        }
        return $user->courses;
        
    }

    
}
