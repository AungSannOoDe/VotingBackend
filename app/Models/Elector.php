<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
