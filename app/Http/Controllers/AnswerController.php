<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    //
    public function all($id , $course_id){
        $answers = Answer::where('user_id' , '=' , $id)->where('course_id' , '=' , $course_id)->get();
        return AnswerResource::collection($answers);
    }


    public function show($id){
        $answer = Answer::find($id);
        if($answer == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        return new AnswerResource($answer);
    }


    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "course_id"=>"required",
            "quiz_id"=>"required",
            "user_id"=>"required",
            "answer"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        Answer::create([
            "user_id"=>$request->user_id,
            "course_id"=>$request->course_id,
            "quiz_id"=>$request->quiz_id,
            "answer"=>$request->answer,
        ]);

        return response()->json([
            "message"=>"Created successfully"
        ], 200);
    }

    public function delete($id){
        $comment = Answer::find($id);
        if($comment == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }

        $comment->delete();
        return response()->json([
            "message"=>"deleted successfully"
        ], 200);
    }
}
