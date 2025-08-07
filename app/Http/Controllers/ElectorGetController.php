<?php

namespace App\Http\Controllers;

use App\Models\Elector;
use Illuminate\Http\Request;
use App\Http\Resources\ElectorResource;

class ElectorGetController extends Controller
{
    public function getElector(Request $request){
          $query=Elector::where('won_status',0)->get();
         return response()->json([
           "message"=>"Temp retrieved succesfully",
           "data"=>$query
        ]);
    }
    public function getElectorHistory(Request $request) {
        $query = Elector::whereIn('won_status', [1,2])->get();
        return response()->json([
            "message" => "Elector history retrieved successfully",
            "data" => $query
        ]);
    }
    public function getDetails($id){
        $elector = Elector::find($id);

        if (!$elector) {
            return response()->json(['message' => 'Elector not found'], 404);
        }
        return response()->json($elector);
    }
}
