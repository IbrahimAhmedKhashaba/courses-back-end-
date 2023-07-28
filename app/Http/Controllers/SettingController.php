<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    //
    public function all(){
        $settings = Setting::all();
        return SettingResource::collection($settings);
    }

    public function show($id){
        $setting = Setting::find($id);
        if($setting == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        return new SettingResource($setting);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "key"=>"required|string|max:100|unique:settings,key",
            "value"=>"required|string|max:100",
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        Setting::create([
            "key"=>$request->key,
            "value"=>$request->value,
        ]);

        return response()->json([
            "message"=>"created successfully"
        ], 200);
    }

    public function update($id , Request $request){
        $setting = Setting::find($id);
        if($setting == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        $validator = Validator::make($request->all(),[
            "key"=>"required|string|max:100|unique:settings,key",
            "value"=>"required|string|max:100",
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $setting->update([
            "key"=>$request->key,
            "value"=>$request->value,
        ]);

        return response()->json([
            "message"=>"upadted successfully"
        ], 200);
    }

    public function delete($id){
        $setting = Setting::find($id);
        if($setting == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }

        $setting->delete();
        return response()->json([
            "message"=>"deleted successfully"
        ], 200);
    }
}
