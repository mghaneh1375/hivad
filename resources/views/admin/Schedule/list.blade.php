@extends('layouts.structure')

@section('header')
    @parent
@stop

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    <h1>مدیریت تقویم هفتگی</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12">
                            <?php $i = 1; ?>
                            <table>
                                <tr>
                                    <td>ردیف</td>
                                    <td>روز</td>
                                    <td>آیا در این روز مجموعه باز است؟</td>
                                    <td>ساعت آغاز به کار</td>
                                    <td>ساعت اتمام به کار</td>
                                    <td>تعداد متخصص فعال در این روز</td>
                                </tr>
                                @foreach($days as $day)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $day['day'] }}</td>
                                        <td>{{ $day['is_open'] ? 'بله' : 'خیر' }}</td>
                                        <td>{{ $day['start'] }}</td>
                                        <td>{{ $day['end'] }}</td>
                                        <td>{{ $day['peoples'] }}</td>
                                        <td>
                                            
                                            <button onclick="document.location.href = '{{ route('schedule.edit', ['schedule' => $day['id']]) }}'" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </button>

                                            @if($day['is_open'])
                                                <button onclick="document.location.href = '{{ route('schedule.people_work_times.index', ['schedule' => $day['id']]) }}'" class="btn btn-success">
                                                    <span class="glyphicon glyphicon-eye-open"></span>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>
@stop