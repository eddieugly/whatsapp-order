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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->whenNotNull($this->description),
            'price' => $this->price,
            'status' => $this->when($request->user()?->can('edit menu'), $this->status),
            'featured' => $this->when($request->user()?->can('edit menu'), $this->featured),
            'slider' => $this->when($request->user()?->can('edit menu'), $this->slider),
            'thumbnail' => $this->whenNotNull($this->thumbnail),
            'category' => new CategoryResource($this->whenLoaded('category')),
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
