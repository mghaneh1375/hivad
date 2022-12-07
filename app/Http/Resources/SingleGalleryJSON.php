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
            "MediaID" => $this->image,
            "AlbumID" => $this->cat_id,
            "BoxID" => null,
            "IsImage" => true,
            "Priority" => $this->priority,
            "Type" => "." . $arr[1],
            "Display" => true,
            "Description" => null,
            "Image" => $this->image,
            "Text" => '<p>' . $this->title . '</p>' . '<div>' . $this->digest . '</div><a>مشاهده بیشتر</a>',
            "DateTime" => "2020-01-01T12 =>14 =>00",
            "WebsiteID" => 762,
            "BaseWebsiteID" => null,
            "BaseMediaID" => null
        ];
    }
}
