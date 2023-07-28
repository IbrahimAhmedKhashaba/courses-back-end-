<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstructorResource;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    //
    public function all(){
        $instructors = Instructor::all();
        return InstructorResource::collection($instructors);
    }

    public function show($id){
        $instructor = Instructor::find($id);
        if($instructor == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        return $instructor;
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|string|max:255",
            "phone"=>"required|string|max:11",
            "salary"=>"required",
            "gender"=>"required|string|max:11",
            "course_id"=>"string|max:11",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        Instructor::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "salary"=>$request->salary,
            "status"=>$request->status ?? 'under_review',
            "gender"=>$request->gender,
            "course_id"=>$request->course_id,
        ]);

        return response()->json([
            "message"=>"created successfully"
        ], 200);
    }


    public function update($id , Request $request){
        $instructor = Instructor::find($id);
        if($instructor == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        $validator = Validator::make($request->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|string|max:255",
            "phone"=>"required|string|max:11",
            "salary"=>"required",
            "status"=>"required|string|max:100",
            "gender"=>"required|string|max:11",
            "course_id"=>"required|string|max:11",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        $instructor->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "salary"=>$request->salary,
            "status"=>$request->status,
            "gender"=>$request->gender,
            "course_id"=>$request->course_id,
        ]);

        return response()->json([
            "message"=>"upadted successfully"
        ], 200);
    }

    public function delete($id){
        $instructor = Instructor::find($id);
        if($instructor == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }

        $instructor->delete();
        return response()->json([
            "message"=>"deleted successfully"
        ], 200);
    }
    public function updateStatus($id){
    $instructor = Instructor::find($id);
    if($instructor == null){
        return response()->json([
            "message"=>"the seleted id is invalid"
        ], 404);
    }
    if($instructor->status == "active"){
        $new_status = "under_review";
    } else {
        $new_status = "active";
    }
    $instructor->update([
        "status"=>$new_status,
    ]);
    return response()->json([
        "message"=>"Updated successfully"
    ], 200);
}
}
