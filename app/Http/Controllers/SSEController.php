<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;
use App\Models\Voter;
use App\Models\Votes;
use Illuminate\Http\Request;

class SSEController extends Controller
{

    public function stream(){
        return response()->stream(function(){
            while(true){
                $votercount=Voter::count();
                $usercount=User::count();
                $tokencount=Token::count();
                $maleCount = Votes::whereHas('elector', function($query) {
                    $query->where('gender', 'male');
                })
                ->count();
                 $feale = Votes::whereHas('elector', function($query) {
                    $query->where('gender', 'female');
                })
                ->count();
                $Completed=Token::where('archived_at', '1')->count();
                $data=[
                    'voter_count' => $votercount,
                    'user_count' => $usercount,
                    'token_count' => $tokencount,
                    'token_completed' => $Completed
                ];
                echo "data: ".json_encode($data)."\n\n";
                ob_flush();
                flush();
                sleep(5);
            }
        },200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
        ]);
    }
}
