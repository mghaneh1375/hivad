<?php

namespace App\Http\Resources;

use App\models\Gallery;
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
            "AlbumID" => $this->id,
            "AlbumName" => $this->title,
            "AlbumDescription" => null,
            "ImageCount" => Gallery::whereCatId($this->id)->count(),
            "tumbDir1" => asset('/Content/images/GalleryPictures/crop/' . $this->image),
            "tumbDir2" => asset('/Content/images/GalleryPictures/crop/' . $this->image),
            "tumbDir3" => asset('/Content/images/GalleryPictures/crop/' . $this->image),
            "DateTime" => "2018-02-04T14 =>30 =>00",
            "ImageHeight" => 570,
            "ImageWidth" => 970,
            "IsSlideShow" => false,
            "Priority" => $this->priority,
            "ParentAlbumID" => null,
            "IsVideo" => false,
            "ImageQuality" => 50,
            "WebsiteID" => 762
        ];
    }
}
