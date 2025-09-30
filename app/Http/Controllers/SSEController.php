<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ablum;
use App\Models\Event;
use App\Models\Token;
use App\Models\Voter;
use App\Models\Votes;
use App\Models\Elector;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SSEController extends Controller
{

    public function stream(){
        return response()->stream(function(){
            while(true){
                $votercount=Voter::count();
                $usercount=User::count();
                $tokencount=Token::count();
                $electorcount=Elector::count();
                $AblumCount=Ablum::count();
                $eventCount=Event::count();
                $galleryCount=Gallery::count();
                $votedVoter = Voter::selectRaw('
                        SUM(CASE WHEN vote_male = 1 THEN 1 ELSE 0 END) as male_count,
                        SUM(CASE WHEN vote_female = 1 THEN 1 ELSE 0 END) as female_count
                    ')
                    ->first();

                $votedMaleCount = $votedVoter->male_count;
                $votedFemaleCount = $votedVoter->female_count;
                $maleCount = Votes::whereHas('elector', function($query) {
                    $query->where('gender', 'male');
                })
                ->count();
                 $feale = Votes::whereHas('elector', function($query) {
                    $query->where('gender', 'female');
                })
                ->count();
  $Completed=Token::where('archived_at','1')->count();
                 $votes = Votes::selectRaw('
                    votes.elector_id,
                    COUNT(*) as vote_count,
                    electors.elector_name as elector_name,
                    electors.gender as gender
                ')
                ->join('electors', 'votes.elector_id', '=', 'electors.id')
                ->groupBy('votes.elector_id', 'electors.elector_name')
                ->orderByDesc('vote_count')
                ->get();
                $resultSuccess=Cache::forget('countdown_time');
                if($resultSuccess){
                     $maleVotes = $votes->where('gender', 'male')->sortByDesc('vote_count');
                    $topMale = $maleVotes->first();
                    $secondMale = $maleVotes->skip(1)->first();
                    $secondMaleVotes = $secondMale ? $secondMale->vote_count : 0;

                    $femaleVotes = $votes->where('gender', 'female')->sortByDesc('vote_count');
                    $topFemale = $femaleVotes->first();
                    $secondFemale = $femaleVotes->skip(1)->first();
                    $secondFemaleVotes = $secondFemale ? $secondFemale->vote_count : 0;
                }
                $data=[
                     'electors' => $votes->map(function ($vote) {
                        return [
                            'elector_id' => $vote->elector_id,
                            'name' => $vote->elector->elector_name ?? 'Unknown',
                            'image' => $vote->elector->image ?? null,
                            'votes' => $vote->vote_count,
                            'gender' => $vote->elector->gender ?? 'unknown',
                        ];
                    })->sortByDesc('votes')->values()->toArray(),
                    'total_votes' => $votes->sum('vote_count'),
                    'voter_count' => $votercount,
                    'user_count' => $usercount,
                    " votedMaleCount"=> $votedMaleCount,
                     "votedFemaleCount"=>$votedFemaleCount,
                     "galleryCount"=> $galleryCount,
                     "eventCount"=>$eventCount,
                     "ablum_count"=> $AblumCount,
                    'elector_count'=> $electorcount,
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
