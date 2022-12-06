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
                    <h1>مدیریت متخصصین روز {{ $schedule['day'] }}</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="flex center">
                            <button onclick="window.location.href = '{{ route('schedule.people_work_times.create', ['schedule' => $schedule['id']]) }}'" class="btn btn-success">افزودن مورد جدید</button>
                        </div>

                        <div class="col-xs-12">
                            <?php $i = 1; ?>
                            <table>
                                <tr>
                                    <td>ردیف</td>
                                    <td>نام متخصص</td>
                                    <td>تخصص</td>
                                    <td>ساعت آغاز به کار</td>
                                    <td>ساعت اتمام به کار</td>
                                    <td>عملیات</td>
                                </tr>
                                @foreach($peoples as $people)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $people['name'] }}</td>
                                        <td>{{ $people['tag'] }}</td>
                                        <td>{{ $people['start'] }}</td>
                                        <td>{{ $people['end'] }}</td>
                                        <td>
                                            
                                            <button onclick="document.location.href = '{{ route('people_work_times.edit', ['people_work_time' => $people['id']]) }}'" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </button>

                                            {{-- <button onclick="document.location.href = '{{ route('schedule.people_work_times.index', ['schedule' => $day['id']]) }}'" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button> --}}

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