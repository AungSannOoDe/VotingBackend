<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    public  function profile(Request $request){
        return response()->json([
            "message"=>"Student Profile retrived successfully",
            "data"=>$request->user(),
        ]);

    }
     public function changeName(ChangeNameRequest $request)
    {
        $user = $request->user();
        $user->update(['name' => $request->name]);

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
