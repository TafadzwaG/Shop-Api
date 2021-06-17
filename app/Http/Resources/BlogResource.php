<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'id'=> $this->id,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'tag' => $this->tag,
            'body' => $this->body,
            'written_by' => $this->posted_by,
            'posted_at' => $this->posted_at,
            'blog_images' => BlogImageResource::collection($this->blog_images)

        ];
    }
}
