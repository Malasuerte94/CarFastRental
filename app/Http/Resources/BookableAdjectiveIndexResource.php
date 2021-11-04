<?php

namespace App\Http\Resources;

use App\Models\Adjective;
use Illuminate\Http\Resources\Json\JsonResource;

class BookableAdjectiveIndexResource extends JsonResource
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
            'value' => $this->value,
            'adjective' => new AdjectiveShowResource(Adjective::findOrFail($this->adjective_id))
        ];
    }
}
