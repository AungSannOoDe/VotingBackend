<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
             'id' => $this->id,
            'voter_name' => $this->voter_name,
            'roll_name'=>$this->roll_name,
            "Major"=>$this->Major,
            "Years"=>$this->Years,
            'voter_email' => $this->voter_email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
