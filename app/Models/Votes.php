<?php

namespace App\Models;

use App\Models\Voter;
use App\Models\Elector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Votes extends Model
{
    /** @use HasFactory<\Database\Factories\VotesFactory> */
    use HasFactory;
    protected $fillable = [
        'voter_id',
        'elector_id',
        'archived_at',
        'vote_code',
    ];
    public function voter(){
        return $this->belongsTo(Voter::class);
       }
       public function elector(){
        return $this->belongsTo(Elector::class);
       }
}
