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
                'id'           => $this->id,
                'elector_name' => $this->elector_name,
                'phone'        => $this->phone,
                'gender'       => $this->gender,
                'years'        => $this->Years,
                'won_status'   => $this->won_status,
                "description" =>$this->description,
                 "address"=>$this->address,

                'albums' => $this->whenLoaded('albums', function () {
                    return $this->albums->map(function ($album) {
                        return [
                            'id'           => $album->id,
                            'elector_id'   => $album->elector_id,
                            'image_1'      => $album->image_1,
                            'image_1_url'  => $album->image_1 ? asset('storage/' . $album->image_1) : null,
                            'image_2'      => $album->image_2,
                            'image_2_url'  => $album->image_2 ? asset('storage/' . $album->image_2) : null,
                            'image_3'      => $album->image_3,
                            'image_3_url'  => $album->image_3 ? asset('storage/' . $album->image_3) : null,
                            'image_4'      => $album->image_4,
                            'image_4_url'  => $album->image_4 ? asset('storage/' . $album->image_4) : null,
                            'created_at'   => $album->created_at,
                            'updated_at'   => $album->updated_at,
                        ];
                    });
                }),
            ];
        }
    }
