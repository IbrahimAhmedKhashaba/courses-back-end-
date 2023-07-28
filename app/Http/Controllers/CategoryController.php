<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDO;

class CategoryController extends Controller
{
    //
    public function all(){
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function show($id){
        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        return new CategoryResource($category);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "title"=>"required|string|max:255",
            "description"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        Category::create([
            "title"=>$request->title,
            "description"=>$request->description
        ]);

        return response()->json([
            "message"=>"created successfully"
        ], 200);
    }

    public function update($id , Request $request){
        $category = Category::find($id);
        if($category == null){
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

        $category->update([
            "title"=>$request->title,
            "description"=>$request->description
        ]);

        return response()->json([
            "message"=>"upadted successfully"
        ], 200);
    
    }

    public function delete($id){
        $category = Category::find($id);
        if($category == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }

        $category->delete();
        return response()->json([
            "message"=>"deleted successfully"
        ], 200);
    }
}
