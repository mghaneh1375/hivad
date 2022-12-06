<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPeopleWorkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $people = $this->people;

        return [
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'name' => $people->name,
            'tag' => $people->tag,
        ];
    }
}
