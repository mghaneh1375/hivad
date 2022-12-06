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
                    @if($mode == 'survey')
                        <h1>مدیریت فرم های نظرسنجی</h1>
                    @else
                        <h1>مدیریت فرم های درخواست مشاوره</h1>
                    @endif
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">
                        
                        <div class="col-xs-12">
                        
                            @foreach($fields as $field)
                                <div style="direction: rtl; text-align: right; border-bottom: 1px solid; margin: 10px; padding: 10px;">
                                    <p>{{ $field['label'] }}</p>
                                    <p>{{ $field['answer'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>
@stop