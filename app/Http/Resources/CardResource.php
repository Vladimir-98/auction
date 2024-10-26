<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'budget' => $this->budgetRange,
            'leadPrice' => $this->lead_price,
            'paymentType' => $this->stringPaymentType,
            'districts' => $this->stringDistricts,
            'categories' => $this->stringTypes,
        ];
    }
}
