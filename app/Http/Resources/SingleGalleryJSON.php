<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleGalleryJSON extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = explode('.', $this->image);

        return [
            
            "TabID" => 5960,
            "BoxID" => 38865,
            "LinkUrl" => null,
            "TempName" => "PageContent",
            "MenuID" => 29264,
            "Title" => $this->title,
            "Titr" => $this->digest,
            "Picture" => $this->image,
            "Priority" => $this->priority,
            "Icon" => null,
            "BaseWebsiteID" => null
        ];
    }
}
