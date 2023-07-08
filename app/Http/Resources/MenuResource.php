<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->whenNotNull($this->description),
            'price' => $this->price,
            'status' => $this->status,
            'featured' => $this->featured,
            'slider' => $this->slider,
            'thumbnail' => $this->whenNotNull($this->thumbnail),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => $this->whenLoaded(
                'media',
                fn () => $this->media->map(
                    fn ($media) => [
                        'id' => $media->id,
                        'html' => $media->toHtml(),
                    ]
                )
            ),
        ];
    }
}
