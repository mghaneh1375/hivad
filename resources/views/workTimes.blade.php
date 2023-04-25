@extends('layouts.siteLayout')

@section('header')
    
    @parent

    <style>
        .hidden {
            display: none !important;
        }
        .modal {
            display: block;
            position: fixed;
            z-index: 100000;
            padding-top: 50px;
            padding-bottom: 50px;
            left: 0;
            top: 100px;
            bottom: 0;
            width: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            padding: 15px !important;
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 70%;
            direction: rtl;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s;
        }
        .gap10 {
            gap: 10px;
        }
        .center {
            align-self: center;
            justify-content: center;
            align-items: center;
        }
        .flex {
            display: flex;
        }
    </style>
@stop

@section('menuId')'54423'@stop
@section('prefix')'workTime-'@stop
@section('menuName')'ساعات-کاری'@stop

@section('customContent')
    <div style="display: flex; flex-direction: column; margin: 30px; gap: 20px">
        @foreach ($days as $day)

            <div style="display: flex; flex-direction: row; gap: 50px;">
                <div style="align-self: center">
                    <h1 style="font-size: 20px">{{ $day['day'] }}</h1>
                    <p style="font-size: 16px">از ساعت {{ $day['start'] }} تا {{ $day['end'] }}</p>
                </div>
                @foreach ($day['peoples'] as $people)
                    <center style="font-size: 14px">
                        <img width="100px" src="{{ $people['img'] }}" />
                        <p>{{ $people['name'] }}</p>
                        <p>{{ $people['tag'] }}</p>
                        @foreach ($people['times'] as $time)
                            <p>از ساعت {{ $time[0] }} تا {{ $time[1] }}</p>
                        @endforeach
                        
                        @if($can_booking)
                            <button onclick="request('{{ $day['num_day'] }}', '{{ $people['name'] }}', {{ json_encode($people['times']) }}, {{ json_encode($people['ids']) }})">درخواست مشاوره</button>
                        @endif
                    </center>
                @endforeach
            </div>
        @endforeach
    </div>

@stop

@section('customModal')
    <div id="registryModal" class="modal hidden">
        <div class="modal-content">

            <h1>درخواست وقت دهی برای <span id="doctor"></span></h1>
            
            @if(Auth::check())
                <div style="margin-top: 10px">
                    <input style="padding: 6px; width: 250px" id="name" value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}" placeholder="نام و نام خانوادگی" type="text" />
                </div>
                
                <div style="margin-top: 10px">
                    <input style="padding: 6px; width: 250px" id="phone" value="{{ Auth::user()->phone }}" placeholder="شماره همراه" type="tel" />
                </div>
            @else
                <div style="margin-top: 10px">
                    <input style="padding: 6px; width: 250px" id="name" placeholder="نام و نام خانوادگی" type="text" />
                </div>
                
                <div style="margin-top: 10px">
                    <input style="padding: 6px; width: 250px" id="phone" placeholder="شماره همراه" type="tel" />
                </div>
            @endif
            

            <div style="margin-top: 10px">
                <label style="font-size: 14px;" for="date">تاریخ موردنظر</label>
                <select style="height: 40px" id="date">
                    <option id="currWeek" value="curr">این هفته</option>
                    <option value="next">هفته بعد</option>
                    <option value="next2">دو هفته بعد</option>
                    <option value="next3">سه هفته بعد</option>
                    <option value="next4">چهار هفته بعد</option>
                </select>
            </div>
            
            <div id="times"></div>

            <div style="margin-top: 10px">
                <label style="font-size: 14px" for="desc">توضیحات تکمیلی</label>
                <textarea id="desc" style="height: 100px" placeholder="این فیلد اختیاری است"></textarea>
            </div>

            <div>
                <input type="button" value="ثبت وقت" class="btn green-btn"  style="margin-top: 30px; margin-left: 5px;" onclick="submit()">
                <input type="button" value="بازگشت" class="btn red-btn"  style="margin-top: 30px; margin-left: 5px;" onclick="$('#registryModal').addClass('hidden')">
            </div>
        </div>
    </div>
@stop

@section('customJS')
    <script>

        let today = parseInt('{{ $today }}');

        function request(day, doctor, times, ids) {

            if(today >= day) {
                $("#currWeek").remove();
            }
            else {
                if($("#currWeek").length === 0) {
                    $("#date").prepend('<option selected id="currWeek" value="curr">این هفته</option>');
                }
            }
            
            if(times.length > 1) {
                
                var html = "<div><label style='font-size: 14px' for='wanted_time'>زمان موردنظر</label><select style='height: 40px' id='wanted_time'>";
                var i = 0;

                times.forEach(elem => {
                    html += "<option value='" + ids[i++] + "'>" + elem[0] + " تا " + elem[1] + "</option>";
                });

                html += '</select></div>';

                $("#times").empty().append(html).removeClass('hidden');
            }
            else {
                $("#times").empty().append("<select id='wanted_time'><option selected value='" + ids[0] + "'></option></select>").addClass('hidden');
            }

            $("#doctor").empty().append(doctor);

            $("#registryModal").removeClass('hidden');
        }

        function submit() {

            let name = $("#name").val();
            let phone = $("#phone").val();

            if(name.length === 0 || phone.length === 0) {
                showErr("لطفا تمامی اطلاعات لازم را پرنمایید");
                return;
            }

            let date = $("#date").val();
            let wantedTime = $("#wanted_time").val();
            let desc = $("#desc").val();

            let data = {
                name: name,
                phone: phone,
                date: date,
                people_work_time_id: wantedTime
            };

            if(desc.length > 0)
                data.description = desc;

            $.ajax({
                type: 'post',
                url: '{{ route('api.submitTimeRequest') }}',
                data: data,
                headers: {
                    'Accept': 'application/json'
                },
                success: function(res) {
                    if(res.status === "ok") {
                        showSuccess("زمان موردنظر شما با موفقیت در سیستم ثبت گردید و با شما تماس گرفته خواهد شد");
                        $('#registryModal').addClass('hidden');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    handleAjaxErr(XMLHttpRequest);
                }
            });

        }

    </script>
@stop

