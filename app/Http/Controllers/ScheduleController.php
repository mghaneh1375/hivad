<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminScheduleResource;
use App\Http\Resources\ScheduleResource;
use App\models\Config;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.Schedule.list', [
            'days' => AdminScheduleResource::collection(Schedule::open())->toArray($request)
        ]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('workTimes', [
            'days' => ScheduleResource::collection(Schedule::all())->toArray($request),
            'can_booking' => Config::first()->online_booking
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule, Request $request)
    {
        return view('admin.Schedule.edit', [
            'day' => AdminScheduleResource::make($schedule)->toArray($request)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validator = [
            'is_open' => 'required|boolean',
            'start' => 'required_if:is_open,true',
            'end' => 'required_if:is_open,true',
        ];

        $request->validate($validator);

        $schedule->is_open = $request['is_open'];
        if($request['is_open']) {
            $schedule->start = $request['start'];
            $schedule->end = $request['end'];
        }
        else {
            $schedule->start = null;
            $schedule->end = null;
        }

        $schedule->save();
        return Redirect::route('schedule.index');
    }

}
