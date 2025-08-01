<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('q');
        $validSortColumns = ['id', 'reviewer_name', 'email'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns, true) ? $request->input('sort_by') : 'id';
        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc'], true) ? $request->input('sort_direction') : 'desc';
        $limit = $request->input('limit', 5);
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? (int)$limit : 5;
        $query = Review::query();
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('reviewer_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ;
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

        return ReviewResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $review = new Review();
        $review->reviewer_name = $request->reviewer_name;
        $review->message = $request->message;
        $review->email = $request->email;
        $review->voter_id = $request->voter_id;
        $review->save();

        return response()->json([
            'message' => 'Review created successfully',
            'data' => new ReviewResource($review)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:events,id',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid product ID'
            ], 404);
        }

        $voter = Review::find($id);

        return response()->json([
            'message' => 'Review retrieved successfully',
            'data' => new ReviewResource($voter)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->only([
            'reviewer_name',
            'message',
            'email',
            'voter_id',
        ]));

        return response()->json([
            'message' => 'Review updated successfully',
            'data' => new ReviewResource($review)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:reviews,id',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid Review ID'
            ], 404);
        }

        $review = Review::find($id);
        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
}
