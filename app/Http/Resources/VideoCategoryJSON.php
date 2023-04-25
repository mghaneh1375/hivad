<?php

namespace App\Http\Resources;

use App\Models\Video;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoCategoryJSON extends JsonResource
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
            "DateTime" => 'تعداد ویدیوها: ' . Video::where('cat_id', $this->id)->visible()->count(),
            "HrefLink" => route('spec-videos', ['category' => $this->id, 'title' => $this->title]),
            "NewsGroupName" => "گالری ویدیو",
            "NewsID" => $this->id,
            "NewsPicture" => $this->image,
            "NewsTitr" => $this->title,
            "Priority" => $this->priority,
            "PublishDate" => null,
            "ShortNews" => ''
        ];
    }
}
