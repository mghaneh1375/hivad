<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminScheduleResource extends JsonResource
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
            'day' => Controller::translate_day($this->day),
            'is_open' => $this->is_open,
            'start' => $this->is_open ? $this->start : '',
            'end' => $this->is_open ? $this->end : '',
            'peoples' => $this->is_open ? $this->peoples()->count() : 0
        ];
    }
}
