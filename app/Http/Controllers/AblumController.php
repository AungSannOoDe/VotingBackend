<?php

namespace App\Http\Controllers;

use App\Models\Ablum;
use Illuminate\Support\Facades\Storage;
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
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAblumRequest $request)
    {
        $image1Name = time() . '_1.' . $request->image_1->extension();
         $image2Name = time() . '_2.' . $request->image_2->extension();
         $image3Name = time() . '_3.' . $request->image_3->extension();
         $image4Name = time() . '_4.' . $request->image_4->extension();
         $request->image_1->storeAs('albums', $image1Name, 'public');
        $request->image_2->storeAs('albums', $image2Name, 'public');
        $request->image_3->storeAs('albums', $image3Name, 'public');
        $request->image_4->storeAs('albums', $image4Name, 'public');
         $ablum = Ablum::create([
            'elector_id' => $request->elector_id,
            'image_1' => 'albums/' . $image1Name,
            'image_2' => 'albums/' . $image2Name,
            'image_3' => 'albums/' . $image3Name,
             'image_4' => 'albums/' . $image4Name,
        ]);
        return response()->json([
            'message' => 'Album created successfully!',
            'data' => $ablum
        ]);
}
     /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = Ablum::where('elector_id', $id)->first();

        if (!$album) {
            return response()->json([
                'message' => 'Album not found'
            ], 404);
        }
        $this->deleteAlbumImages($album);
        $album->delete();
        return response()->json([
            'message' => 'Album and all associated images deleted successfully'
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

        $albums = Ablum::with('elector')
            ->where('elector_id', $id)
            ->get()
            ->map(function ($album) {
                $album->image_1_url = asset('storage/' . $album->image_1);
                $album->image_2_url = asset('storage/' . $album->image_2);
                $album->image_3_url = asset('storage/' . $album->image_3);
                 $album->image_4_url = asset('storage/' . $album->image_4);
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
    public function updateImage(UpdateAblumRequest $request)
    {
         $album = Ablum::where('elector_id', $request->elector_id)->first();

        if (!$album) {
            return response()->json(['message' => 'Album not found'], 404);
        }
        $updateData = [];

        // Handle each image update individually
        if ($request->hasFile('image_1')) {
            if ($album->image_1 && Storage::disk('public')->exists($album->image_1)) {
                Storage::disk('public')->delete($album->image_1);
            }
            // Store new image
            $imageName = "elector_{$request->elector_id}_image_1_".time().'.'.$request->file('image_1')->extension();
            $path = $request->file('image_1')->storeAs('albums', $imageName, 'public');
            $updateData['image_1'] = $path;
        }
        if ($request->hasFile('image_2')) {
            if ($album->image_2 && Storage::disk('public')->exists($album->image_2)) {
                Storage::disk('public')->delete($album->image_2);
            }
            $imageName = "elector_{$request->elector_id}_image_2_".time().'.'.$request->file('image_2')->extension();
            $path = $request->file('image_2')->storeAs('albums', $imageName, 'public');
            $updateData['image_2'] = $path;
        }
        if ($request->hasFile('image_3')) {
            if ($album->image_3 && Storage::disk('public')->exists($album->image_3)) {
                Storage::disk('public')->delete($album->image_3);
            }
            $imageName = "elector_{$request->elector_id}_image_3_".time().'.'.$request->file('image_3')->extension();
            $path = $request->file('image_3')->storeAs('albums', $imageName, 'public');
            $updateData['image_3'] = $path;
        }
        if ($request->hasFile('image_4')) {
            if ($album->image_4 && Storage::disk('public')->exists($album->image_4)) {
                Storage::disk('public')->delete($album->image_4);
            }
            $imageName = "elector_{$request->elector_id}_image_4_".time().'.'.$request->file('image_4')->extension();
            $path = $request->file('image_4')->storeAs('albums', $imageName, 'public');
            $updateData['image_4'] = $path;
        }
        if (!empty($updateData)) {
            $album->update($updateData);
        }
        return response()->json([
            'message' => 'Album images updated successfully',
            'data' => $album->fresh() 
        ]);
    }
}


