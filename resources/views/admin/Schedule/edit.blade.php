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
                    <h1>{{ 'ویرایش برنامه ' . $day['day'] }}</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" style="padding: 0">
                            
                            <div style="margin-top: 10px;">
                                <form id="myForm" action="{{ route('api.schedule.update', ['schedule' => $day['id']])}}" method="post">
                                    @csrf

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        
                                        <div>
                                            <label for="is_open">آیا در این روز مجموعه باز است؟</label>
                                            <select onchange="changeSelect(this.value)" name="is_open" id="is_open">
                                                <option {{ $day['is_open'] ? 'selected' : '' }} value="1">بله</option>
                                                <option {{ !$day['is_open'] ? 'selected' : '' }} value="0">خیر</option>
                                            </select>
                                        </div>
                                        
                                        <div class="is_open {{ $day['is_open'] ? '' : 'hidden' }}">
                                            <label for="start">ساعت آغاز به کار مجموعه</label>
                                            <input value="{{ $day['start'] }}" type="time" name="start" id="start" />
                                        </div>
                                        
                                        <div class="is_open {{ $day['is_open'] ? '' : 'hidden' }}">
                                            <label for="end">ساعت اتمام کار مجموعه</label>
                                            <input value="{{ $day['end'] }}" type="time" name="end" id="end" />
                                        </div>

                                    </div>
                        

                                    <div class="flex center gap10">
                                        <span onclick="document.location.href = '{{ route('schedule.index') }}'" class="btn btn-danger">بازگشت</span>
                                        <input type="submit" value="ذخیره" class="btn green" id="saveBtn" />
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

    <script>

        function changeSelect(val) {
            if(val === "1")
                $(".is_open").removeClass('hidden');
            else
                $(".is_open").addClass('hidden');
        }

    </script>

@stop