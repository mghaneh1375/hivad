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
                    <h1>مدیریت فیلم ها</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="flex center">
                            <button onclick="window.location.href = '{{ route('addVideo') }}'" class="btn btn-success">افزودن مورد جدید</button>
                        </div>

                        <div class="col-xs-12">
                            @foreach($videos as $video)
                                <div style="min-height: 250px" class="column col-xs-12 col-lg-3 myContainer" id="item_{{ $video->id }}">
                                    <img src="{{asset('Content/images/GalleryPictures/crop/'.$video->image)}}" alt="{{ $video->alt }}" style="width:100%; height: 100%">
                                    <div class="overlay">
                                        <div class="opBox" id="opBox_{{ $video->id }}">
                                            <button class="btn btn-default" onclick="play('{{$video->file}}')">پخش</button>
                                            <button class="btn btn-primary" onclick="document.location.href = '{{ route('editVideo', ['video' => $video->id]) }}'">ویرایش</button>
                                            <button class="btn btn-danger" onclick="remmoveModal('item', {{$video->id}}, '{{ route('api.removeVideo', ['video' => $video->id]) }}')">حذف</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>

   
    <div id="playModal" class="modal hidden">
        <div class="modal-content" style="width: 70%;">
            <video id="video" width="100%" controls>
                
                Your browser does not support the video tag.
              </video> 
            <div class="flex center gap10">
                <input type="button" value="بازگشت" class="btn green"  style="margin-bottom: 3%; margin-left: 5px;" onclick="$('#playModal').addClass('hidden')">
            </div>
        </div>
    </div>


    <script>

        function play(url) {
            $("#video").attr('src', url);
            $("#playModal").removeClass('hidden');
        }

    </script>
@stop