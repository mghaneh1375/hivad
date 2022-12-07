<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserAdviceRequestResource;
use App\Models\UserAdviceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class UserAdviceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $seen = $request->query('seen');
        if($seen != null && $seen == 'false')
            $requests = UserAdviceRequest::unSeen()->orderBy('id', 'desc')->get();
        else
            $requests = UserAdviceRequest::orderBy('id', 'desc')->get();

        DB::update('update user_advice_requests set seen = true where seen = false');

        return view('admin.UserAdviceRequest.list', [
            'forms' => UserAdviceRequestResource::collection($requests)->toArray($request)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = [
            'name' => 'required|string|min:2',
            'phone' => 'required|regex:/(09)[0-9]{9}/',
            'date' => ['required', Rule::in(['curr', 'next', 'next2', 'next3', 'next4'])],
            'people_work_time_id' => 'required|exists:people_work_times,id',
            'description' => 'nullable|string|min:2'
        ];

        $request->validate($validator);
        UserAdviceRequest::create($request->toArray());
        return response()->json(['status' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAdviceRequest  $userAdviceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(UserAdviceRequest $userAdviceRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAdviceRequest  $userAdviceRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAdviceRequest $userAdviceRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAdviceRequest  $userAdviceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = [
            'status' => ['required', Rule::in(['pending', 'accepted', 'rejected'])],
            'user_advice_request_id' => 'required|integer|exists:user_advice_requests,id'
        ];

        $request->validate($validator);
        
        $userAdviceRequest = UserAdviceRequest::whereId($request['user_advice_request_id'])->first();
        
        $userAdviceRequest->status = $request['status'];
        $userAdviceRequest->save();

        return response()->json(['status' => 'ok']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAdviceRequest  $userAdviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAdviceRequest $userAdviceRequest)
    {
        $userAdviceRequest->delete();
        return response()->json(['status' => 'ok']);
    }
}
