<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'status' => $this->when($request->user()?->can('edit category'), $this->status),
            'featured' => $this->when($request->user()?->can('edit category'), $this->featured),
            'menus' => MenuResource::collection($this->whenLoaded('menus')),
            'menus_count' => $this->whenCounted('menus_count'),
        ];
    }
}
