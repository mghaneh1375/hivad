<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryJSON extends JsonResource
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
            "TabID" => 5959 + $this->id,
            "BoxID" => 38865,
            "LinkUrl" => "",
            "TempName" => "PageContent",
            "MenuID" => 29263 + $this->id,
            "Title" => $this->title,
            "Titr" => $this->tags,
            "Picture" => $this->image,
            "Priority" => $this->priority,
            "Icon" => null,
        ];
    }
}
