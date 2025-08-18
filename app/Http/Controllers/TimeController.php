<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Votes;
use App\Models\Elector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreTimeRequest;
use App\Http\Requests\UpdateTimeRequest;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request )
    // {
    //     $searchTerm = $request->input('q');
    //     $validSortColumns = ['id', 'time_name'];
    //     $sortBy = in_array($request->input('sort_by'), $validSortColumns, true) ? $request->input('sort_by') : 'id';
    //     $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc'], true) ? $request->input('sort_direction') : 'desc';
    //     $limit = $request->input('limit', 5);

    //     $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? (int)$limit : 5;

    //     $query = Time::query();
    //     if ($searchTerm) {
    //         $query->where('time_name', 'like', '%' . $searchTerm . '%');
    //     }
    //     $query->orderBy($sortBy, $sortDirection);

    //     $times = $query->paginate($limit);

    //     return response()->json([
    //         'message' => 'Times retrieved successfully',
    //         'data' => $times
    //     ]);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreTimeRequest $request)
    // {
    //     $time = Time::create($request->validated());

    //     return response()->json([
    //         'message' => 'Time created successfully',
    //         'data' => $time
    //     ], 201);
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show($id)
    // {
    //     $time = Time::find($id);

    //     if (!$time) {
    //         return response()->json([
    //             'message' => 'Time not found'
    //         ], 404);
    //     }
    //     return response()->json([
    //         'message' => 'Time retrieved successfully',
    //         'data' => $time
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateTimeRequest $request, Time $time)
    // {
    //     $validatedData = $request->validated();
    //     $time->update($validatedData);

    //     return response()->json([
    //         'message' => 'Time updated successfully',
    //         'data' => $time
    //     ]);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Time $time)
    // {
    // }

     public function getTime()
    {
        $remaining = Cache::get('countdown_time', 0);
        return response()->json([
            'success' => Cache::has('countdown_time'),
            'remaining' => $remaining,
            'is_active' => $remaining > 0
        ]);
    }
    public function setTime(Request $request)
    {
        $request->validate([
            'seconds' => 'required|integer|min:0'
        ]);
        Cache::put('countdown_time', $request->seconds, now()->addDay());

        return response()->json([
            'remaining' => $request->seconds
        ]);
    }

    public function resetTime()
    {
        Cache::forget('countdown_time');
         $votes = Votes::selectRaw('
            votes.elector_id,
            COUNT(*) as vote_count,
            electors.elector_name as elector_name,
            electors.gender as gender
        ')
        ->join('electors', 'votes.elector_id', '=', 'electors.id')
        ->groupBy('votes.elector_id', 'electors.elector_name')
        ->orderByDesc('vote_count')
        ->get();
          $maleVotes = $votes->where('gender', 'male')->sortByDesc('vote_count');
        $topMale = $maleVotes->first();
        $secondMale = $maleVotes->skip(1)->first();
        $secondMaleVotes = $secondMale ? $secondMale->vote_count : 0;
        $femaleVotes = $votes->where('gender', 'female')->sortByDesc('vote_count');
        $topFemale = $femaleVotes->first();
        $secondFemale = $femaleVotes->skip(1)->first();
        $secondFemaleVotes = $secondFemale ? $secondFemale->vote_count : 0;
        Elector::query()->update(['won_status' => 0]);
         if ($topMale) {
            Elector::where('id', $topMale->elector_id)->update(['won_status' => 1]);
        }
        if ($topFemale) {
            Elector::where('id', $topFemale->elector_id)->update(['won_status' => 1]);
        }
        return response()->json([
            'success' => true,
            'remaining' => 0
        ]);
    }
}
