<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TimeController extends Controller
{

    public function getRemainingTime()
    {
        // Get the end time from database or cache
        $endTime = Cache::remember('timer_end', now()->addDays(30), function() {
            return now()->addMinutes(30); // Example: 30 minute timer
        });

        return response()->json([
            'remaining' => $endTime->diffInSeconds(now()),
            'end_time' => $endTime
        ]);
    }
}
