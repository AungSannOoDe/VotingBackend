<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('q');
        $validSortColumns = ['id', 'event_name', 'event_start_time', 'event_participant'];
        $sortBy = in_array($request->input('sort_by'), $validSortColumns, true) ? $request->input('sort_by') : 'id';
        $sortDirection = in_array($request->input('sort_direction'), ['asc', 'desc'], true) ? $request->input('sort_direction') : 'desc';
        $limit = $request->input('limit', 5);
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? (int)$limit : 5;
        $query = Event::query();
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('event_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('event_start_time', 'like', '%' . $searchTerm . '%')
                    ->orWhere('event_participant', 'like', '%' . $searchTerm . '%');
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

        return EventResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $event = new Event();
        $event->event_name = $request->event_name;
        $event->event_participant = $request->event_participant;
        $event->event_start_time = $request->event_start_time;
        $event->save();

        return response()->json([
            'message' => 'Event created successfully',
            'data' => new EventResource($event)
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
                'message' => 'Invalid event ID',
                'errors' => $validated->errors()
            ], 422);
        }

        $event = Event::find($id);
         return response()->json([
            'message' => 'Event retrieved successfully',
            'data' => new EventResource($event)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->only([
            'event_name',
            'event_participant',
            'event_start_time',
        ]));

        return response()->json([
            'message' => 'Event updated successfully',
            'data' => new EventResource($event)
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
                'message' => 'Invalid product ID'
            ], 404);
        }

        $voter = Voter::find($id);

        $voter->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
