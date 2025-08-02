<?php

namespace App\Models;

use App\Models\tempo;
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
        "won_status"
    ];
    public function tempo()
    {
        return $this->hasOne(tempo::class);
    }
}
