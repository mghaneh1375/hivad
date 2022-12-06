<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeopleWorkResource extends JsonResource
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
            'ids' => $this->ids,
            'times' => $this->times,
            'name' => $people->name,
            'tag' => $people->tag,
            'img' => asset('Content/images/shortcutTab/' . $people->image)
        ];
    }
}
