<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductJSON extends JsonResource
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
            "DateTime" => number_format($this->price, 0) . ' تومان',
            "HrefLink" => route('product', ['product' => $this->id, 'title' => $this->title]),
            "NewsGroupName" =>"فروشگاه",
            "NewsID" => $this->id,
            "NewsPicture" => $this->image,
            "NewsTitr" => $this->title,
            "Priority" => $this->priority,
            "PublishDate" => null,
            "ShortNews" => $this->digest
        ];
    }
}
