<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all()->map(function ($gallery) {
            $gallery->image_url = asset('storage/' . $gallery->images);
            return $gallery;
        });
        return response()->json([
            "message" => "Galleries retrieved successfully",
            "data" => $galleries
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension();
            $request->images->storeAs('gallery', $imageName, 'public');
            $imagePath = 'gallery/' . $imageName;
        }
        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'images' => $imagePath,
        ]);
        return response()->json([
            'message' => 'Gallery created successfully',
            'data' => $gallery
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery not found'], 404);
        }
        if ($gallery->images) {
            $gallery->image_url = asset('storage/' . $gallery->images);
        }

        return response()->json([
            'message' => 'Gallery retrieved successfully',
            'data' => $gallery
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */

     public function  updateGallery(UpdateGalleryRequest $request){
         $gallery=Gallery::findOrFail($request->id);
         $updateData = [
            'title' => $request->title,
            'description' => $request->description,
        ];
        if ($request->hasFile('images')) {
            if ($gallery->images && Storage::disk('public')->exists($gallery->images)) {
                Storage::disk('public')->delete($gallery->images);
            }
            $imagePath = $request->file('images')->store('gallery', 'public');
            $updateData['images'] = $imagePath;
        }
        $gallery->update($updateData);

        return response()->json([
            'message' => 'Gallery updated successfully',
            'data' => $gallery
        ]);

     }
    // public function update(UpdateGalleryRequest $request, Gallery $gallery)
    // {
    //     $gallery->title = $request->title;
    //     $gallery->description = $request->description;

    //     if ($request->hasFile('images')) {
    //         if ($gallery->images && Storage::disk('public')->exists($gallery->images)) {
    //             Storage::disk('public')->delete($gallery->images);
    //         }

    //         $imagePath = $request->file('images')->store('gallery', 'public');
    //         $gallery->images = $imagePath;
    //     }

    //     $gallery->save();

    //     return response()->json([
    //         'message' => 'Gallery updated successfully',
    //         'data' => $gallery
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
   $gallery=Gallery::find($id);

    if (!$gallery) {
            return response()->json(['message' => 'Gallery not found'], 404);
        }

        if ($gallery->images && Storage::disk('public')->exists($gallery->images)) {
            Storage::disk('public')->delete($gallery->images);
        }
        $gallery->delete();
        return response()->json(['message' => 'Gallery deleted successfully'],200);
    }
}
