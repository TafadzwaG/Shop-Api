<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeAdResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'image' => preg_replace('/^public/', '', $this->image ),
            'was' => $this->was,
            'is_now' => $this->is_now,
            'simple' => $this->simple,
        ];
    }
}
