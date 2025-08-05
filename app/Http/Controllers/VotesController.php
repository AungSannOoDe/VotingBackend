<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVotesRequest;
use App\Http\Requests\UpdateVotesRequest;
use App\Models\Votes;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVotesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Votes $votes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVotesRequest $request, Votes $votes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Votes $votes)
    {
        //
    }
}
