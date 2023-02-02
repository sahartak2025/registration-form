<?php

namespace App\Http\Resources\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Country $resource
 */
class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'label' => $this->resource->autocompleteLabel,
            'idd' => $this->resource->idd,
        ];
    }
}
