<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function profile($id){
        $user = User::distinct()->find($id);
        return new UserResource($user);
    }
}
