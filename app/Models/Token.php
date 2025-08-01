<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Token extends Model
{
    /** @use HasFactory<\Database\Factories\TokenFactory> */
    use HasFactory;
    protected $fillable=[
        "token_name",
        "archived_at"
    ];
}
