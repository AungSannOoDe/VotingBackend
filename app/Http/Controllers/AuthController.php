<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;
use App\Models\Voter;
use Illuminate\Http\Request;
use App\Http\Requests\TokenLogin;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TokenRegister;
use App\Http\Resources\TokeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\voterLoginRequest;

class AuthController extends Controller
{
    public function voterLogin(voterLoginRequest $request){
        $voter = Voter::where('voter_email', $request->voter_email)->first();
        if (!$voter || !Hash::check($request->voter_password, $voter->voter_password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $voter->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token,
         "data"=>  $voter
    ],201);
    }
    public function tokenLogin(TokenLogin $request){
        $token = Token::where('token_name', $request->token_name)->first();
         if($token && $token->archived_at==1){
            return response()->json(['message'=>'Token is archived'],401);
         }
            $token->archived_at = 1;
            $token->save();
             return response()->json([
                'message' => 'Token login successful',
                'data' => new TokeResource($token)
            ]);
    }
    public function voterRegister(TokenRegister $request){
     $voting=Voter::create([
        "voter_name"=>$request->voter_name,
        "voter_email"=>$request->voter_email,
        "voter_password"=>Hash::make($request->voter_password)
     ]);
     $voter = Voter::where('id', $voting->id)->first();
     $token = $voter->createToken('auth_token')->plainTextToken;
     return response()->json([ "token"=>$token, 'voters' => $voter]);
    }
    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }
    public function login(LoginRequest $request){
         if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
