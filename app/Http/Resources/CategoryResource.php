<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'kind' => $this->resource->kind,
            'max_size' => $this->resource->max_size,
            'max_age' => $this->resource->max_age,
            'grow_factor' => $this->resource->growth_factor
        ];
    }
}
