<?php

namespace App\Http\Controllers;

use App\Models\Ablum;
use App\Http\Requests\StoreAblumRequest;
use App\Http\Requests\UpdateAblumRequest;
use Illuminate\Support\Facades\Validator;

class AblumController extends Controller
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
    public function store(StoreAblumRequest $request)
    {
          $image1Name = time() . '_1.' . $request->image_1->extension();
         $image2Name = time() . '_2.' . $request->image_1->extension();
         $image3Name = time() . '_3.' . $request->image_1->extension();

         $request->image_1->storeAs('albums', $image1Name, 'public');
        $request->image_2->storeAs('albums', $image2Name, 'public');
        $request->image_3->storeAs('albums', $image3Name, 'public');

         $ablum = Ablum::create([
            'elector_id' => $request->elector_id,
            'image_1' => 'albums/' . $image1Name,
            'image_2' => 'albums/' . $image2Name,
            'image_3' => 'albums/' . $image3Name,
        ]);

        return response()->json([
            'message' => 'Album created successfully!',
            'data' => $ablum
        ]);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Validate elector_id
        $validated = Validator::make(['elector_id' => $id], [
            'elector_id' => 'required|integer',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid elector ID',
                'errors' => $validated->errors()
            ], 422);
        }

        // Get albums with elector relationship
        $albums = Ablum::with('elector')
            ->where('elector_id', $id)
            ->get()
            ->map(function ($album) {
                $album->image_1_url = asset('storage/' . $album->image_1);
                $album->image_2_url = asset('storage/' . $album->image_2);
                $album->image_3_url = asset('storage/' . $album->image_3);
                return $album;
            });
        return response()->json([
            "message" => "Albums retrieved successfully",
            "data" => $albums
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAblumRequest $request, Ablum $ablum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ablum $ablum)
    {
        //
    }
}
