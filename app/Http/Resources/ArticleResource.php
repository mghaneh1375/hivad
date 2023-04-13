<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            "LinkUrl" => route('spec-article', ['article' => $this->id]),
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
