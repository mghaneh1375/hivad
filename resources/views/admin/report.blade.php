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
                    <h1>گزارشگیری فروش</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12">
                                            
                            <table id="table" data-toggle="table" data-search="true" data-show-columns="true" data-key-events="true"
                                data-show-toggle="true" data-resizable="true" data-show-export="true" data-click-to-select="true"
                                data-toolbar="#toolbar">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th> مقدار سفارش(تومان) </th>
                                        {{-- <th> مقدار تخفیف(تومان)</th> --}}
                                        <th>تاریخ ایجاد</th>
                                        <th>شماره همراه کاربر</th>
                                        <th>نام کاربر</th>
                                        <th>کدرهگیری</th>
                                        <th>شماره مرجع</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ number_format($item['amount'] / 10) }}</td>
                                            <td>{{ $item['created_at'] }}</td>
                                            <td>{{ $item['user']['phone'] }}</td>
                                            <td>{{ $item['user']['name'] }}</td>
                                            <td>{{ $item['tracking_code'] }}</td>
                                            <td>{{ $item['ref_num'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>

@stop
