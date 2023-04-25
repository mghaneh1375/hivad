<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleJSON extends JsonResource
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
            "HrefLink" => route('spec-article', ['article' => $this->id]),
            "NewsGroupName" =>"مقالات",
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
