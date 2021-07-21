<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'image' => preg_replace('/^public/', '', $this->image ),
            'products' =>ProductResource::collection($this->products),
            'products_count' => $this->products_count,
            'subcategory' => ($this->subcategory)
        ];
    }
}
