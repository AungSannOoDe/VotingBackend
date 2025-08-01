<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;
use App\Http\Resources\VoterResource;
use App\Http\Requests\StoreVoterRequest;
use App\Http\Requests\UpdateVoterRequest;
use Illuminate\Support\Facades\Validator;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('q');
        $validSortColumns = ['id', 'voter_name', 'voter_email'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns, true) ? $request->input('sort_by') : 'id';
        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc'], true) ? $request->input('sort_direction') : 'desc';
        $limit = $request->input('limit', 5);

        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? (int)$limit : 5;

        $query = Voter::query();
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('voter_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('voter_email', 'like', '%' . $searchTerm . '%');
            });
        }
        $query->orderBy($sortBy, $sortDirection);

        $products = $query->paginate($limit);

        $products->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit,
        ]);

        return VoterResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoterRequest $request)
    {
       $voters=new Voter();
        $voter ->voter_name= $request->voter_name;
        $voter ->voter_email= $request->voter_email;
        $voter ->voter_password= bcrypt($request->voter_password);
        $voter ->profile_image= $request->profile_image;
        $voter ->token_id= $request->token_id;
        $product->save();
         return response()->json([
            'message' => 'Voters created successfully',
            'data' => new VoterResource($product)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:voters,id',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid product ID'
            ], 404);
        }

        $voter = Voter::find($id);

        return response()->json([
            'message' => 'Voter retrieved successfully',
            'data' => new VoterResource($voter)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voter $voter)
    {
         $voter->update($request->only([
            'voter_name',
            'voter_email',
        ]));

        return response()->json([
            'message' => 'Voter updated successfully',
            'data' => new VoterResource($voter)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:voters,id',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid Voter ID'
            ], 404);
        }

        $voter = Voter::find($id);

        $voter->delete();

        return response()->json([
            'message' => 'Voters deleted successfully'
        ]);
    }
}
