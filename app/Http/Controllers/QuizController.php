<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    //
    public function all($id){
        $quizes = Quiz::where('course_id', '=', $id)->get();
        return QuizResource::collection($quizes);
    }

    public function questions(){
        $questions = Quiz::select('id' , 'question')->get();
        return $questions;
        // return QuizResource::collection($quizes);
    }

    public function show($id){
        $quiz = Quiz::find($id);
        if($quiz == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        return new QuizResource($quiz);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "course_id"=>"required",
            "question"=>"required|string",
            "answer"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        Quiz::create([
            "course_id"=>$request->course_id,
            "question"=>$request->question,
            "answer"=>$request->answer
        ]);

        return response()->json([
            "message"=>"created successfully"
        ], 200);
    }

    public function update($id , Request $request){
        $category = Quiz::find($id);
        if($category == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        $validator = Validator::make($request->all(),[
            "course_id"=>"required",
            "question"=>"required|string",
            "answer"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        $category->update([
            "course_id"=>$request->course_id,
            "question"=>$request->question,
            "answer"=>$request->answer
        ]);

        return response()->json([
            "message"=>"upadted successfully"
        ], 200);
    }

    public function delete($id){
        $quiz = Quiz::find($id);
        if($quiz == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }

        $quiz->delete();
        return response()->json([
            "message"=>"deleted successfully"
        ], 200);
    }
}
