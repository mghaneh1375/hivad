<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryJSON extends JsonResource
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
            "DateTime" => '',
            "HrefLink" => null,
            "NewsGroupName" =>"اخبار",
            "NewsID" => $this->id,
            "NewsPicture" => asset('/Content/images/GalleryPictures/crop/' . $this->image),
            "NewsTitr" => $this->title,
            "Priority" => $this->priority,
            "PublishDate" => null,
            "ShortNews" => '',
            "Tags" => '',
            "VisiteCount" => $this->numOfGalleries
        ];
    }
}
