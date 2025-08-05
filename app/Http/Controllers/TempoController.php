<?php

namespace App\Http\Controllers;

use App\Models\tempo;
use Illuminate\Http\Request;
use App\Http\Resources\TempResource;
use App\Http\Requests\StoretempoRequest;
use App\Http\Requests\UpdatetempoRequest;
use Illuminate\Support\Facades\Validator;

class TempoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretempoRequest $request)
    {
      $temp=new tempo();
      $temp->elector_id=$request->elector_id;
      $temp->voter_id=$request->voter_id;
      $temp->save();
        return response()->json([
            'message' => 'Voters created successfully',
            'data' => new TempResource($temp)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validated = Validator::make(['voter_id' => $id], [
            'voter_id' => 'required|integer',
        ]);
        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid temp ID',
                'errors' => $validated->errors()
            ], 422);
        }
        $temp=tempo::with("elector")->where('voter_id',$id)->get();
        return response()->json([
           "message"=>"Temp retrieved succesfully",
           "data"=>$temp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetempoRequest $request, tempo $tempo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer',
        ]);
          if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid temp ID'
            ], 404);
        }
        $temp=tempo::where('id',$id)->delete();
        return [
            "message"=>"temp  Deleted successfully"
        ];
    }
}
