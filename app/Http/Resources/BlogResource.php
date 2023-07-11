<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ulid,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->whenNotNull($this->description),
            'status' => $this->status,
            'featured' => $this->featured,
            'slider' => $this->slider,
            'thumbnail' => $this->whenNotNull($this->thumbnail),
            'blogcategory' => new BlogcategoryResource($this->whenLoaded('blogcategory')),
            'images' => $this->whenLoaded(
                'media',
                fn () => $this->getMedia()->map(
                    fn ($media) => [
                        'id' => $media->id,
                        'html' => $media->toHtml(),
                    ]
                )
            ),
        ];
    }
}
