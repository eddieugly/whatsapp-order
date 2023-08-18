<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'amount' => $this->amount,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
            'cart' => $this->cart,
            'addon' => $this->whenNotNull($this->addon, 'No Addons'),
            'tx_ref' => $this->whenNotNull($this->tx_ref, 'Pay on Pickup'),
            'payment_status' => $this->payment_status,
            'payment_method' => $this->payment_method,
            'order_status' => $this->order_status,
            'created_at' => diffForHumans($this->created_at),
            'created_date' => showDateTime($this->created_at),
        ];
    }
}
