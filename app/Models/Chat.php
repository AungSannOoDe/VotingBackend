<?php

namespace App\Models;

use App\Models\User;
use App\Models\Voter;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    /** @use HasFactory<\Database\Factories\ChatFactory> */
    use HasFactory;
    public function voter(): BelongsTo
    {
        return $this->belongsTo(Voter::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
     public function getOtherParticipant($participant)
    {
        if ($participant instanceof User) {
            return $this->voter;
        }
        return $this->user;
    }
}
