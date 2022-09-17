<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderCafe extends JsonResource
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
            "SliderID" => $this->id,
            "AlbumID" => 1,
            "LinkUrl" => "",
            "TempName" => null,
            "MenuID" => null,
            "PicAlt" => $this->alt,
            "Picture" => $this->image,
            "Content" => null,
            "BaseWebsiteID" => null,
            "Priority" => $this->priority,
            "SlideDescription" => null
        ];
    }
}
