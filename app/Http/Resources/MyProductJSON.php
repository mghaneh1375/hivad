<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyProductJSON extends JsonResource
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
            "HrefLink" => route('product', ['product' => $this->product->id, 'title' => $this->product->title]),
            "NewsGroupName" =>"فروشگاه",
            "NewsID" => $this->product->id,
            "NewsPicture" => $this->product->image,
            "NewsTitr" => $this->product->title,
            "Priority" => $this->product->priority,
            "PublishDate" => null,
            "ShortNews" => $this->product->digest
        ];
    }
}
