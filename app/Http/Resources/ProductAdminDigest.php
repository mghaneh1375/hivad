<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductAdminDigest extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'digest' => $this->digest,
            'visibility' => $this->visibility,
            'is_imp' => $this->is_imp,
            'buyers' => 0,
            'img' => asset('Content/images/products/crop/' . $this->image),
            'file' => asset('Content/images/products/crop/' . $this->file)
        ];
    }
}
