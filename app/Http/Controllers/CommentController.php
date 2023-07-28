<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    public function all($id){
        $comments = Comment::where('course_id', '=', $id)->get();
        return CommentResource::collection($comments);
    }

    public function show($id){
        $comment = Comment::find($id);
        if($comment == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        return new CommentResource($comment);
    }


    public function create(Request $request , $id){
        $validator = Validator::make($request->all(),[
            "comment"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        Comment::create([
            "course_id"=>$id,
            "comment"=>$request->comment,
        ]);

        return response()->json([
            "message"=>"Created successfully"
        ], 200);
    }



    public function delete($id){
        $comment = Comment::find($id);
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
