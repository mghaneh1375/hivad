<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            "TabID" => 5960,
            "BoxID" => 38865,
            "LinkUrl" => route('single-video', ['video' => $this->id]),
            "TempName" => "PageContent",
            "MenuID" => 29264,
            "Title" => $this->title,
            "Titr" => '',
            "Picture" => $this->image,
            "Priority" => $this->priority,
            "Icon" => null,
            "BaseWebsiteID" => null
        ];
    }
}
