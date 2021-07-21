<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
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
            'stock' => $this->stock,
            'totalPrice' => round((1 - ($this->discount/100)) * $this->price, 2),
            'rating' =>$this->reviews->count() > 0 ? round($this->reviews->sum('star')/ $this->reviews->count()) : 'Rate Now',
            'discount' => $this->discount,
            'product_images' => ProductImageResource::collection($this->product_images),
            'categories' => $this->categories,
            'href' => [

                'link' => route('products.show', $this->id)
            ]
        ];
    }
}



