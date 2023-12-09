<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExtraResource extends JsonResource
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
            'text' => $this->name,
            'name' => $this->name,
            'required' => $this->is_required,
            'extra_options' => ExtraOptionResource::collection($this->whenLoaded('extra_options')),
        ];
    }
}
