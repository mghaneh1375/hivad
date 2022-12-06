<?php

namespace App\Http\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $people = $this->peoples()->orderBy('priority', 'asc')->get();
        $all_peoples = [];
        $people_ids = [];

        foreach($people as $p) {
            
            $idx = -1;
            $i = 0;

            foreach($people_ids as $id) {
                if($id == $p->people_id) {
                    $idx = $i;
                    break;
                }

                $i++;
            }

            if($idx < 0) {
                
                $p->times = [[$p->start, $p->end]];
                $p->ids = [$p->id];

                array_push($all_peoples, $p);
                array_push($people_ids, $p->people_id);
                continue;
            }

            $tmp = $all_peoples[$idx];
            $times = $tmp->times;
            $ids = $tmp->ids;
            array_push($times, [$p->start, $p->end]);
            array_push($ids, $p->id);
            $tmp->times = $times;
            $tmp->ids = $ids;
            $all_peoples[$idx] = $tmp;
        }

        return [
            'day' => Controller::translate_day($this->day),
            'start' => $this->start,
            'end' => $this->end,
            'peoples' => PeopleWorkResource::collection($all_peoples)->toArray($request)
        ];
    }
}
