<?php

namespace App\Models;

use App\Models\tempo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Voter extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\VoterFactory> */
    use HasFactory,Notifiable,HasApiTokens;
    protected $fillable = [
        'voter_name',
        'voter_email',
        'voter_password',
        'profile_image',
        'Years',
        'Major',
        'roll_name'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function tempo()
    {
        return $this->hasOne(tempo::class);
    }
}
