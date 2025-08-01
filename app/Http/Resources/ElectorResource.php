<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "elector_name"=>$this->elector_name,
            "phone"=>$this->phone,
            "address"=>$this->address,
            "gender"=>$this->gender,
            "Years"=>$this->Years,
            "won_status"=>$this->won_status
        ];
    }
}
