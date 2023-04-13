<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'created_at' => Controller::MiladyToShamsi2($this->created_at->timestamp),
            'ref_num' => $this->ref_num,
            'product' => $this->product->title,
            'amount' => $this->amount,
            'tracking_code' => $this->tracking_code,
            'user' => [
                'name' => $this->user->first_name . ' ' . $this->user->last_name,
                'phone' => $this->user->phone
            ]
        ];
    }
}
