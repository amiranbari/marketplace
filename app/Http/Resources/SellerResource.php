<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'           =>  $this->id,
            'title'        =>  $this->title,
            'lat'          =>  $this->lat,
            'longitude'    =>  $this->longitude
        ];
    }
}
