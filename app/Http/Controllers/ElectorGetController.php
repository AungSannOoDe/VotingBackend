<?php

namespace App\Http\Controllers;

use App\Models\Elector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ElectorResource;

class ElectorGetController extends Controller
{
    public function getElector(Request $request){
        $searchTerm = $request->input('q');
        $validSortColumns = ['electors.id', 'elector_name', 'phone', 'gender', 'Years', 'won_status'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns, true) ? $request->input('sort_by') : 'electors.id';
        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc'], true) ? $request->input('sort_direction') : 'desc';
        $limit = $request->input('limit', 100);
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? (int)$limit : 5;

        $query = DB::table('electors')
            ->leftJoin('ablums', 'electors.id', '=', 'ablums.elector_id')
            ->where('Years','=','2025')
            ->select(
                'electors.id',
                'electors.elector_name',
                'electors.phone',
                'electors.gender',
                'electors.Years',
                'electors.won_status',
                'ablums.id as album_id',
                'ablums.image_1',
                'ablums.image_2',
                'ablums.image_3',
                'ablums.image_4',
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_1) as image_1_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_2) as image_2_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_3) as image_3_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_4) as image_4_url")
            );
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('electors.elector_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('electors.phone', 'like', '%' . $searchTerm . '%')
                    ->orWhere('electors.Years', 'like', '%' . $searchTerm . '%')
                    ->orWhere('electors.gender', 'like', '%' . $searchTerm . '%');
            });
        }

        $query->orderBy($sortBy, $sortDirection);

        $results = $query->paginate($limit);

        $results->appends([
            'q' => $searchTerm,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'limit' => $limit,
        ]);
        return response()->json($results);
    }

public function getMaleElector(Request $request){
    $query = DB::table('electors')
    ->select(
        'electors.id',
        'electors.elector_name',
        'electors.phone',
        'electors.gender',
        'electors.Years',
         'electors.description',
        'electors.won_status',
        'ablums.id as album_id',
        'ablums.image_1',
        'ablums.image_2',
        'ablums.image_3',
        'ablums.image_4',
        DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_1) as image_1_url"),
        DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_2) as image_2_url"),
        DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_3) as image_3_url"),
        DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_4) as image_4_url")
    ) ->where('electors.Years', '=', '2025')->where('electors.gender','male')
    ->leftJoin('ablums', 'electors.id', '=', 'ablums.elector_id')
    ->get();
    return response()->json([
        "data"=>$query
    ]);
}
public function getFemaleElector(Request $request){
    $query = DB::table('electors')
    ->select(
        'electors.id',
        'electors.elector_name',
        'electors.phone',
        'electors.gender',
        'electors.Years',
         'electors.description',
        'electors.won_status',
        'ablums.id as album_id',
        'ablums.image_1',
        'ablums.image_2',
        'ablums.image_3',
        'ablums.image_4',
        DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_1) as image_1_url"),
        DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_2) as image_2_url"),
        DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_3) as image_3_url"),
        DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_4) as image_4_url")
    ) ->where('electors.Years', '=', '2025')->where('electors.gender','female')
    ->leftJoin('ablums', 'electors.id', '=', 'ablums.elector_id')
    ->get();
    return response()->json([
        "data"=>$query
    ]);
}

    public function getElectorHistory(Request $request) {
        $year = $request->query('year');
           $query = DB::table('electors')
        ->select(
            'electors.id',
            'electors.elector_name',
            'electors.phone',
            'electors.gender',
            'electors.Years',
             'electors.description',
            'electors.won_status',
            'ablums.id as album_id',
            'ablums.image_1',
            'ablums.image_2',
            'ablums.image_3',
            'ablums.image_4',
            DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_1) as image_1_url"),
            DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_2) as image_2_url"),
            DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_3) as image_3_url"),
            DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_4) as image_4_url")
        )
        ->where('electors.Years', '!=', '2025')
         ->whereIn('electors.won_status', [1, 2])
         ->leftJoin('ablums', 'electors.id', '=', 'ablums.elector_id');
         if ($year && $year !== "All") {
            $query->where('electors.Years', '=', $year);
        }
        $result = $query->get();
         return  response()->json([
            "message"=>"History  retrieved successfully ",
            "data"=>$result
        ]);
    }
    public function getDetailsHistory($id){
          $query = DB::table('electors')
        ->select(
            'electors.id',
            'electors.elector_name',
            'electors.phone',
            'electors.gender',
            'electors.Years',
             'electors.description',
            'electors.won_status',
            'ablums.id as album_id',
            'ablums.image_1',
            'ablums.image_2',
            'ablums.image_3',
            'ablums.image_4',
            DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_1) as image_1_url"),
            DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_2) as image_2_url"),
            DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_3) as image_3_url"),
            DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_4) as image_4_url")
        )
        ->whereIn('electors.won_status', [1, 2])
        ->where('electors.id',$id)
         ->where('electors.Years', '<', '2025')
         ->leftJoin('ablums', 'electors.id', '=', 'ablums.elector_id')
        ->first();
         return  response()->json([
            "message"=>"History  retrieved successfully ",
            "data"=>$query
        ]);
    }
    public function getWining(Request $request){
        $query = DB::table('electors')
            ->select(
                'electors.id',
                'electors.elector_name',
                'electors.phone',
                'electors.gender',
                'electors.Years',
                'electors.won_status',
                'ablums.id as album_id',
                'ablums.image_1',
                'ablums.image_2',
                'ablums.image_3',
                'ablums.image_4',
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_1) as image_1_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_2) as image_2_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_3) as image_3_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_4) as image_4_url")
            )
            ->whereIn('electors.won_status', [1, 2])
             ->where('electors.Years', '=', '2025')
             ->leftJoin('ablums', 'electors.id', '=', 'ablums.elector_id')
            ->get();

        return  response()->json([
            "message"=>"Elector Success retrieved successfully ",
            "data"=>$query
        ]);
    }
    public function getDetails($id){

         $elector = DB::table('electors')
            ->select(
                'electors.id',
                'electors.elector_name',
                'electors.phone',
                'electors.gender',
                'electors.Years',
                'electors.description',
                'electors.won_status',
                'ablums.id as album_id',
                'ablums.image_1',
                'ablums.image_2',
                'ablums.image_3',
                'ablums.image_4',
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_1) as image_1_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_2) as image_2_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_3) as image_3_url"),
                DB::raw("CONCAT('" . asset('storage') . "/', ablums.image_4) as image_4_url")
            )
             ->where('electors.Years', '=', '2025')
            ->where('electors.id', $id)
             ->leftJoin('ablums', 'electors.id', '=', 'ablums.elector_id')
            ->first();
        if (!$elector) {
            return response()->json(['message' => 'Elector not found'], 404);
        }
        return response()->json($elector);
    }
}
