<?php

namespace App\Models;

use App\Models\Voter;
use App\Models\Elector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tempo extends Model
{
    /** @use HasFactory<\Database\Factories\TempoFactory> */
    use HasFactory;
   protected $fillable=[
   "elector_id",
   "voter_id"
   ];
   public function voter(){
    return $this->belongsTo(Voter::class);
   }
   public function elector(){
    return $this->belongsTo(Elector::class);
}
}
