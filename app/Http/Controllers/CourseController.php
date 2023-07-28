<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CourseController extends Controller
{
    //C
    public function all(){
        $courses = Course::all();
        return CourseResource::collection($courses);
    }

    public function show($id){
        $course = Course::find($id);
        // dd($course->instructors);
        // echo "<pre>";
        // print_r($course);
        if($course == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
                
            ], 404);
        }
        // dd($course);
        return new CourseResource($course);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "title"=>"required|string|max:255",
            "description"=>"required|string",
            "num_of_hours"=>"required",
            "price"=>"required",
            "category_id"=>"required",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        Course::create([
            "title"=>$request->title,
            "description"=>$request->description,
            "num_of_hours"=>$request->num_of_hours,
            "price"=>$request->price,
            "category_id"=>$request->category_id,
        ]);

        return response()->json([
            "message"=>"created successfully",
            "data"=>[
                "title"=>$request->title,
                "description"=>$request->description,
                "num_of_hours"=>$request->num_of_hours,
                "price"=>$request->price,
                "category_id"=>$request->category_id,
            ]
        ], 200);
    }

    public function update($id , Request $request){
        $course = Course::find($id);
        if($course == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        $validator = Validator::make($request->all(),[
            "title"=>"required|string|max:255",
            "description"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        $course->update([
            "title"=>$request->title,
            "description"=>$request->description,
            "num_of_hours"=>$request->num_of_hours,
            "price"=>$request->price,
        ]);

        return response()->json([
            "message"=>"upadted successfully"
        ], 200);
    
    }


    public function delete($id){
        $course = Course::find($id);
        if($course == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }

        $course->delete();
        return response()->json([
            "message"=>"deleted successfully"
        ], 200);
    }
}
