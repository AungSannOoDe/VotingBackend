<?php

namespace App\Models;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     public function conversation(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender(): MorphTo
    {
        return $this->morphTo();
    }
}
