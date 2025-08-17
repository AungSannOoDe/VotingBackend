<?php

namespace App\Models;

use App\Models\Elector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ablum extends Model
{
    /** @use HasFactory<\Database\Factories\AblumFactory> */
    use HasFactory;
    protected $fillable=[
     "image_1",
     "image_2",
     "image_3",
     "image_4",
     "elector_id"
    ];
    public function Elector(){
        return $this->belongsTo(Elector::class);
    }
}
