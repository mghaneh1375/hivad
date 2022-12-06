@extends('layouts.structure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{asset('css/createStyle.css')}}" />
@stop

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    <h1>{{ isset($people) ? 'ویرایش ساعت کاری' : 'افزودن متخصص در روز ' . $day }}</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" style="padding: 0">
                            
                            <div style="margin-top: 10px;">
                                <form id="myForm" action="{{ isset($people) ? route('api.peopleWorkTime.update', ['peopleWorkTime' => $people['id']]) : route('api.peopleWorkTime.store', ['schedule' => $schedule])}}" method="post">
                                    @csrf

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        
                                        <div>
                                            <label for="people_id">متخصص</label>
                                            <select required id="people_id" name="people_id">
                                                <option>انتخاب کنید</option>
                                                @foreach ($peoples as $itr)
                                                    <option {{ isset($people) && $itr['id'] == $people['people_id'] ? 'selected' : '' }} value="{{ $itr['id'] }}">{{ $itr['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label for="priority">اولویت</label>
                                            <input value="{{ isset($people) ? $people['priority'] : '' }}" type="number" required name="priority" id="priority" />
                                        </div>

                                        <div>
                                            <label for="start">ساعت آغاز به کار</label>
                                            <input required value="{{ isset($people) ? $people['start'] : '' }}" type="time" name="start" id="start" />
                                        </div>
                                        
                                        <div>
                                            <label for="end">ساعت اتمام کار</label>
                                            <input required value="{{ isset($people) ? $people['end'] : '' }}" type="time" name="end" id="end" />
                                        </div>

                                    </div>
                        

                                    <div class="flex center gap10">
                                        <span onclick="document.location.href = '{{ route('schedule.people_work_times.index', ['schedule' => $schedule]) }}'" class="btn btn-danger">بازگشت</span>
                                        <input type="submit" value="ذخیره" class="btn green" id="saveBtn">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
@stop