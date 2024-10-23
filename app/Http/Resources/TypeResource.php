<?php

namespace App\Http\Resources;

use App\Http\Filters\CardFilter;
use App\Models\Card\Card;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
{
    public function __construct($resource)
    {

        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $filterData['filter']['categories'] = [$this->id];
        $formRequest = new FormRequest($filterData);
        $cardFilter = new CardFilter($formRequest);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'img' => $this->icon,
            'total' => Card::filter($cardFilter)->count(),
            'active' => false,
        ];
    }
}
