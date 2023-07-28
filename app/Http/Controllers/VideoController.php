<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuizResource;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    //
    public function all($id){
        $videos = Video::where('course_id', '=', $id)->get();
        return VideoResource::collection($videos);
    }

    public function show($id){
        $video = Video::find($id);
        if($video == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        return new VideoResource($video);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "course_id"=>"required",
            "title"=>"required|string",
            "link"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        Video::create([
            "course_id"=>$request->course_id,
            "title"=>$request->title,
            "link"=>$request->link
        ]);

        return response()->json([
            "message"=>"created successfully"
        ], 200);
    }


    public function update($id , Request $request){
        $video = Video::find($id);
        if($video == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        $validator = Validator::make($request->all(),[
            "course_id"=>"required",
            "title"=>"required|string",
            "link"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        $video->update([
            "course_id"=>$request->course_id,
            "title"=>$request->title,
            "link"=>$request->link
        ]);

        return response()->json([
            "message"=>"upadted successfully"
        ], 200);
    }

    public function delete($id){
        $video = Video::find($id);
        if($video == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }

        $video->delete();
        return response()->json([
            "message"=>"deleted successfully"
        ], 200);
    }
}
