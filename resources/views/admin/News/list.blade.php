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
                    <h1>مدیریت اخبار</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">
                        
                        <div class="flex center">
                            <button onclick="window.location.href = '{{ route('addNews') }}'" class="btn btn-success">افزودن مورد جدید</button>
                        </div>

                        <div class="col-xs-12">
                            @foreach($allNews as $news)
                                <div style="min-height: 250px" class="column col-xs-12 col-lg-3 myContainer" id="item_{{ $news->id }}">
                                    <img src="{{asset('Content/images/news/crop/' . $news->image)}}" alt="{{ $news->alt }}" style="max-width:100%; max-height: 100%">
                                    <div class="overlay">
                                        <div class="opBox" id="opBox_{{ $news->id }}">
                                            <button class="btn btn-primary" onclick="document.location.href = '{{ route('editNews', ['news' => $news->id]) }}'">ویرایش</button>
                                            <button class="btn btn-danger" onclick="remmoveModal('item', {{$news->id}}, '{{ route('api.removeNews', ['news' => $news->id]) }}')">حذف</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>
@stop