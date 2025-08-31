<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\profileResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangeNameRequest;
use App\Http\Requests\ChangeImageRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeProfileImageRequest;

class profileController extends Controller
{
     public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
   
    /**
     * Change password.
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'Old password is incorrect'], 401);
        }
        $user->update(['password' => Hash::make($request->new_password)]);
        $user->tokens()->delete();
        return response()->json(['message' => 'Password changed successfully']);
    }
    public function  changeImage(ChangeImageRequest $request){
         $user=$request->user();
         if ($user->image && Storage::exists($user->image)) {
            Storage::delete($user->image);
         }
         $path = $request->file('image')->store('users', 'public');
         $user->image = $path;
         $user->save();
         return response()->json([
            'message' => 'Image updated successfully',
            'image_url' => Storage::url($path)
        ],200);
         
    }
    /**
     * Change name.
     */
    public function changeName(ChangeNameRequest $request)
    {
        $user = $request->user();
        $user->update(['name' => $request->name]);

        return response()->json([
            'message' => 'Name changed successfully',
            'user' => new profileResource($user),
        ]);
    }

    /**
     * Change profile image.
     */
    public function changeProfileImage(ChangeImageRequest $request)
    {
        $user = $request->user();

        if ($user->image) {
            Storage::delete($user->image);
        }
        $imagePath = $request->file('image')->store('users', 'public');
        $user->update(['image' => $imagePath]);
        return response()->json([
            'message' => 'Profile image changed successfully',
            'user' => new profileResource($user),
        ]);
    }

    /**
     * Get user profile.
     */
    public function profile(Request $request)
    {
        return response()->json([
            'message' => 'User profile retrieved successfully',
            'data' => new profileResource($request->user()),
        ]);
    }
}
