<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsJSON extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $d = date("Y-m-d H:i:s", strtotime($this->created_at));

       return [
            "DateTime" => $d,
            "HrefLink" => route('show-news', ['news' => $this->id, 'title' => $this->title]),
            "NewsGroupName" =>"اخبار",
            "NewsID" => $this->id,
            "NewsPicture" => $this->image,
            "NewsTitr" => $this->title,
            "Priority" => $this->priority,
            "PublishDate" => null,
            "ShortNews" => $this->digest,
            "Tags" => $this->tags,
            "VisiteCount" => 199
        ];
    }
}
