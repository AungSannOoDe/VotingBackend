<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    public  function profile(Request $request){
        return response()->json([
            "message"=>"Student Profile retrived successfully",
            "data"=>new VoterResource($request->user()),
        ]);

    }
}
