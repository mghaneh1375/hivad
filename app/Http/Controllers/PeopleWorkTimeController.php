<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminPeopleWorkResource;
use App\Http\Resources\AdminScheduleResource;
use App\Http\Resources\PeopleDigest;
use App\Http\Resources\PeopleResource;
use App\Http\Resources\PeopleWorkResource;
use App\models\People;
use App\Models\PeopleWorkTime;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PeopleWorkTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Schedule $schedule, Request $request)
    {
        return view('admin.PeopleWork.list', [
            'schedule' => AdminScheduleResource::make($schedule)->toArray($request),
            'peoples' => AdminPeopleWorkResource::collection($schedule->peoples)->toArray($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Schedule $schedule, Request $request)
    {
        return view('admin.PeopleWork.create', [
            'schedule' => $schedule['id'],
            'day' => self::translate_day($schedule['day']),
            'peoples' => PeopleDigest::collection(People::all())->toArray($request)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Schedule $schedule, Request $request)
    {
        $validator = [
            'people_id' => 'required|exists:people,id',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
            'priority' => 'required|integer|min:1'
        ];

        $request->validate($validator);
        $request['schedule_id'] = $schedule->id;

        PeopleWorkTime::create($request->toArray());
        return Redirect::route('schedule.people_work_times.index', ['schedule' => $schedule->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeopleWorkTime  $peopleWorkTime
     * @return \Illuminate\Http\Response
     */
    public function show(PeopleWorkTime $peopleWorkTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeopleWorkTime  $peopleWorkTime
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleWorkTime $peopleWorkTime, Request $request)
    {
        $schedule = $peopleWorkTime->schedule;
        return view('admin.PeopleWork.create', [
            'schedule' => $peopleWorkTime->schedule->id,
            'day' => self::translate_day($schedule->day),
            'peoples' => PeopleDigest::collection(People::all())->toArray($request),
            'people' => AdminPeopleWorkResource::make($peopleWorkTime)->toArray($request)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeopleWorkTime  $peopleWorkTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeopleWorkTime $peopleWorkTime)
    {
        $validator = [
            'people_id' => 'required|exists:people,id',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
            'priority' => 'required|integer|min:1'
        ];

        $request->validate($validator);

        $peopleWorkTime->people_id = $request['people_id'];
        $peopleWorkTime->start = $request['start'];
        $peopleWorkTime->end = $request['end'];
        $peopleWorkTime->priority = $request['priority'];

        $peopleWorkTime->save();

        return Redirect::route('schedule.people_work_times.index', ['schedule' => $peopleWorkTime->schedule_id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeopleWorkTime  $peopleWorkTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleWorkTime $peopleWorkTime)
    {
        $delete = $peopleWorkTime->delete();
        if($delete)
            return response()->json(['status' => 'ok']);
        
        return response()->json(['status' => 'nok', 'msg' => 'نفراتی تقاضای این زمان را کرده اند و ابتدا باید آن درخواست ها لغو شوند']);
    }
}
