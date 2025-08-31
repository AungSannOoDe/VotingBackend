<?php

namespace App\Http\Controllers;

use App\Models\Elector;
use Illuminate\Http\Request;
use App\Http\Resources\ElectorResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreElectorRequest;
use App\Http\Requests\UpdateElectorRequest;

class ElectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

  public function getChampion(Request $request){
      $champions=Elector::where('vote_same',1)->get();
      return response()->json([
        "success"=>true,
        "data"=>$champions
      ],200);
  }

    public function index(Request $request)
    {
        $searchTerm = $request->input('q');
        $validSortColumns = ['id', 'elector_name', 'phone', 'gender','Years',"won_status"];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns, true) ? $request->input('sort_by') : 'id';
        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc'], true) ? $request->input('sort_direction') : 'desc';
        $limit = $request->input('limit', 5);
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? (int)$limit : 5;
        $query = Elector::query();
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('elector_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                    ->orWhere('Years', 'like', '%' . $searchTerm . '%')
                    ->orWhere('gender', 'like', '%' . $searchTerm . '%');
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

        return ElectorResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreElectorRequest $request)
    {
        $elector = new Elector();
        $elector->elector_name = $request->elector_name;
        $elector->phone = $request->phone;
        $elector->Years = $request->Years;
        $elector->gender=$request->gender;
        $elector->won_status=$request->won_status;
        $elector->address=$request->address;
        $elector->description=$request->description;
        $elector->save();
        return response()->json([
            'message' => 'elector created successfully',
            'data' => new ElectorResource($elector)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:electors,id',
        ]);
        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid event ID',
                'errors' => $validated->errors()
            ], 422);
        }
        $electors = Elector::find($id);
         return response()->json([
            'message' => 'Elector retrieved successfully',
            'data' => new ElectorResource($electors)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateElectorRequest $request, Elector $elector)
    {
        $elector->update($request->only([
            "elector_name",
            "phone",
            "address",
            "gender",
            "Years",
            "won_status"
        ]));
        return response()->json([
            'message' => 'elector updated successfully',
            'data' => new ElectorResource($elector)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $validated = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:electors,id',
        ]);
        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid product ID'
            ], 404);
        }
        $elector = Elector::find($id);

        $elector->delete();

        return response()->json([
            'message' => 'Elector deleted successfully'
        ]);
    }
    }
