<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'customer' => $this->customer,
            'body' => $this->review,
            'star' => $this->star
        ];
    }
}
