<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoterProfileController extends Controller
{
    public function voterLogout(Request $request)
    {
        $voter = Auth::guard('voter')->user();
        
        if (!$voter) {
            return response()->json(['message' => 'No authenticated voter'], 401);
        }
        $voter->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
