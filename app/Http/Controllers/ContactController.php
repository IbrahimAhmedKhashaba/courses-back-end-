<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function all(){
        $contacts = Contact::all();
        return ContactResource::collection($contacts);
    }

    public function show($id){
        $contact = Contact::find($id);
        if($contact == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        return new ContactResource($contact);
    }


    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|string|max:255",
            "phone"=>"required|string|max:11",
            "message"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        Contact::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "message"=>$request->message,
        ]);

        return response()->json([
            "message"=>"Thank You For Communicating With Us"
        ], 200);
    }

    public function update($id , Request $request){
        $contact = Contact::find($id);
        if($contact == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }
        $validator = Validator::make($request->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|string|max:255",
            "phone"=>"required|string|max:11",
            "message"=>"required|string",
        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors()
            ] , 301);
        }

        $contact->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "message"=>$request->message,
        ]);

        return response()->json([
            "message"=>"upadted successfully"
        ], 200);
    }

    public function delete($id){
        $contact = Contact::find($id);
        if($contact == null){
            return response()->json([
                "message"=>"the seleted id is invalid"
            ], 404);
        }

        $contact->delete();
        return response()->json([
            "message"=>"deleted successfully"
        ], 200);
    }
}
