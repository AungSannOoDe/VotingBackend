<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangeMaleRequest;
use App\Http\Requests\ChangeNameRequest;

class StudentProfileController extends Controller
{
    public  function profile(Request $request){
        return response()->json([
            "message"=>"Student Profile retrived successfully",
            "data"=>$request->user(),
        ]);
    }
    public function changeMale(ChangeMaleRequest $request){
        $user = $request->user();
        $user->update(['vote_male' => $request->vote_male]);
        return response()->json([
            'message' => 'Male Vote Change successfully',
            'user' => $user,
        ]);        
    }
     public function changeName(ChangeNameRequest $request)
    {
        $user = $request->user();
        $user->update(['voter_name' => $request->voter_name]);

        return response()->json([
            'message' => 'Name changed successfully',
            'user' => $user,
        ]);

    }
     public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();

        if (!Hash::check($request->old_password, $user->voter_password)) {
            return response()->json(['message' => 'Old password is incorrect'], 401);
        }
        $user->update(['password' => Hash::make($request->new_password)]);
        $user->tokens()->delete();
        return response()->json(['message' => 'Password changed successfully']);
    }
}
