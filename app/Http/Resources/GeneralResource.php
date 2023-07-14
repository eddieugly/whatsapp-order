<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralResource extends JsonResource
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
            'company_name' => $this->company_name,
            'company_tagline' => $this->company_tagline,
            'company_abbrevation' => $this->company_abbrevation,
            'company_description' => $this->company_description,
            'company_phone' => $this->company_phone,
            'company_email' => $this->company_email,
            'company_address' => $this->company_address,
            'company_seo_description' => $this->company_seo_description,
            'company_seo_keywords' => $this->company_seo_keywords,
            'company_footer_text' => $this->company_footer_text,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
        ];
    }
}
