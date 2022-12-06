<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminFieldResource extends JsonResource
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
            'id' => $this->id,
            'label' => $this->label,
            'type' => $this->type,
            'slug' => $this->slug,
            'for' => $this->for,
            'options' => $this->options != null ? explode('__', $this->options) : null,
            'is_required' => $this->is_required,
            'visibility' => $this->visibility,
            'priority' => $this->priority
        ];
    }
}
