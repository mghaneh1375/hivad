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
                    <h1>مدیریت افراد متخصص</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" id="itemsContainer">

                            <div class="flex center">
                                <button onclick="document.location.href = '{{ route('people.create') }}'" class="btn btn-success">افزودن مورد جدید</button>
                            </div>

                            @foreach ($peoples as $item)
                                <div class="column col-xs-12 col-lg-4 myContainer" id="item_{{ $item->id }}">
                                    <img src="{{asset('Content/images/shortcutTab/' . $item->image)}}" alt="{{ $item->alt }}" style="width:100%; height: 100%">
                                    <div class="overlay">
                                        <div class="opBox" id="opBox_{{ $item->id }}">
                                            <p>{{ $item->name }}</p>

                                            @if($item->tag != null)
                                                <p>{{ $item->tag }}</p>
                                            @endif

                                            <button class="btn btn-primary" onclick="document.location.href = '{{ route('people.edit', ['people' => $item]) }}'">مشاهده اطلاعات</button>
                                            <button class="btn btn-danger" onclick="remmoveModal('item', {{$item->id}}, '{{ route('api.removePeople', ['people' => $item->id]) }}')">حذف</button>
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

    <script>

        function editIntroduce(id) {

            $.ajax({
                type: 'put',
                url: '{{ route('api.updatePeople') }}' + '/' + id,
                data: {
                    'priority': $("#priority_" + id).val(),
                    'alt': $("#alt_" + id).val()
                },
                headers: {
                    "accept": "application/json"
                },
                success: function(res) {
                    if(res.status === "ok") {
                        alert('عملیات موردنظر با موفقیت انجام شد.');
                        $('#opBox_' + id).removeClass('hidden'); 
                        $('#infoBox_' + id).addClass('hidden');
                    }
                }
            });

        }

    </script>
@stop