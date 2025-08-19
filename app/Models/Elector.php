<?php

namespace App\Models;

use App\Models\Ablum;
use App\Models\tempo;
use App\Models\Votes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Elector extends Model
{
    /** @use HasFactory<\Database\Factories\ElectorFactory> */
    use HasFactory;
    protected  $fillable=[
        "elector_name",
        "phone",
        "address",
        "gender",
        "Years",
        "description",
        "won_status"
    ];
    public function tempo()
    {
        return $this->hasOne(tempo::class);
    }
    public function votes()
    {
        return $this->hasOne(Votes::class);
    }
    public function Ablum(){
        return $this->hasMany(Ablum::class);
    }
}
