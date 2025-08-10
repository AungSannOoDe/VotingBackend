<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVotesRequest;
use App\Http\Requests\UpdateVotesRequest;
use App\Models\Votes;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $votes = Votes::get();
        return response()->json([
            'message' => 'Votes retrieved successfully',
            'data' => $votes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVotesRequest $request)
    {
         
        $vote = Votes::create([
            'voter_id' => $request->voter_id,
            'elector_id' => $request->elector_id,
            'vote_code' => $request->vote_code,
            'archived_at' => $request->archived_at,
        ]);
        $elector = $vote->elector;
        $updateField = ($elector->gender === 'male') ? 'vote_male' : 'vote_female';
        $vote->voter->update([$updateField => 1]);
        $vote->load('voter');
        return response()->json([
            'message' => 'Vote created successfully',
            'data' => $vote
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vote = Votes::where('voter_id',$id)->with(['voter', 'elector'])->get();
        return response()->json([
            'message' => 'Vote retrieved successfully',
            'data' => $vote
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVotesRequest $request, Votes $votes)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vote = Votes::findOrFail($id);
        $vote->delete();
        return response()->json([
            'message' => 'Vote deleted successfully'
        ]);
    }
}
