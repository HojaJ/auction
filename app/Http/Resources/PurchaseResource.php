<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'lot_id' => $this->lot_id,
            'lot_name' => $this->lot->name,
            'price' => $this->price,
            'seller' => $this->lot->user->name,
            'created_at' => $this->created_at->toDayDateTimeString(),
        ];
    }
}
