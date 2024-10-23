<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FilterResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'type' => $this->type,
            'dropDown' => $this->dropDown,
            'active' => $this->active,
            'items' => $this->getResourcesAll(),
        ];

    }

    private function getResourcesAll(): ResourceCollection|array
    {
        try {
            $model = $this->items;

            if (is_string($model) && is_subclass_of($model, Model::class)) {
                return $model::getAllCollection();
            }

            return [];
        } catch (\Exception $e) {

            Log::info('Filter error: ' . $e->getMessage());
            return [];
        }

    }
}
