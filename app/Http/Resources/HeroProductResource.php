<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class HeroProductResource extends JsonResource
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
            'id'    => $this->id,
            'title' => $this->bookable->title,
            'price' => $this->bookable->price,
            'year'  => $this->bookable->year,
            'image' => Storage::url($this->bookable->main_image),
            'features' => BookableFeatureCollection::collection($this->bookable->bookableFeaturesDisplayed),
        ];
    }
}
