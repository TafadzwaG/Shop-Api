<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_id' => $this->product_id,
            'name' => $this->name,
            'email' => $this->email,
            'review' => $this->review,
            'review_title' => $this->review_title,
            'star' => $this->star,
            'date_posted' => $this->created_at,
        ];
    }
}
