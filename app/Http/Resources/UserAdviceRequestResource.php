<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAdviceRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $time = $this->people_work_time;
        $people = $time->people;

        $date = $this->date;
        switch($date) {
            case "curr":
                $date = "هفته فعلی";
                break;
            case "next":
                $date = "هفته بعد";
                break;
            case "next2":
                $date = "دو هفته بعد";
                break;
            case "next3":
                $date = "سه هفته بعد";
                break;
            case "next4":
                $date = "چهار هفته بعد";
                break;
        }

        switch($this->status) {
            case "pending":
            default:
                $status = "در حال بررسی";
                break;
            case "accepted":
                $status = " پذیرفته شده";
                break;
            case "rejected":
                $status = " رد شده";
                break;
        }

        return [
            'id' => $this->id,
            'description' => $this->description,
            'phone' => $this->phone,
            'name' => $this->name,
            'status' => $status,
            'date' => $date,
            'start' => $time->start,
            'end' => $time->end,
            'seen' => $this->seen,
            'people' => $people->name,
            'tag' => $people->tag,
            'created_at' => date("Y-m-d H:i:s", strtotime($this->created_at))
        ];
    }
}
