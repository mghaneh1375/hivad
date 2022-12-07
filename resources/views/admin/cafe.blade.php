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
                    <h1>مدیریت معرفی کافه</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <textarea style="width: 100%; padding: 10px; height: 300px;" id="about">{{ $about }}</textarea>

                        <button onClick="save()" class="btn btn-success">تایید</button>

                        <div class="col-xs-12 hidden" id="addContainer">
                            
                            <div class="column" style="border: solid;">
                                
                                <div style="margin-top: 10px;">
                                    <form id="add_slide_show" action="{{route('api.addCafeItem')}}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="kind" value="save">

                                        <div class="flex flex-col center gap10" style="margin: 10px">
                                            <input type="file" name="image" required id="imgInp">
                                            <div>
                                                <label for="priority">اولویت</label>
                                                <input type="number" required name="priority" id="priority" />
                                            </div>
                                            <div>
                                                <label for="alt">تگ alt</label>
                                                <input type="text" placeholder="این فیلد اختیاری است" name="alt" id="alt" />
                                            </div>
                                        </div>

                                        <div class="flex center gap10">
                                            <span onclick="$('#itemsContainer').removeClass('hidden'); $('#addContainer').addClass('hidden')" class="btn btn-danger">بازگشت</span>
                                            <input type="submit" value="ذخیره" class="btn green">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="col-xs-12" id="itemsContainer">

                            <div class="flex center">
                                <button onclick="$('#itemsContainer').addClass('hidden'); $('#addContainer').removeClass('hidden')" class="btn btn-success">افزودن مورد جدید</button>
                            </div>

                            @foreach ($all_cafe_items as $item)
                                <div class="column col-xs-12 col-lg-4 myContainer" id="item_{{ $item->id }}">
                                    <img src="{{URL::asset('Content/images/GalleryPictures/crop/' . $item->image)}}" alt="{{ $item->alt }}" style="width:100%; height: 100%">
                                    <div class="overlay">
                                        <div class="opBox" id="opBox_{{ $item->id }}">
                                            <button class="btn btn-primary" onclick="$('#opBox_{{ $item->id }}').addClass('hidden'); $('#infoBox_{{ $item->id }}').removeClass('hidden')">مشاهده اطلاعات</button>
                                            <button class="btn btn-danger" onclick="remmoveModal('item', {{$item->id}}, '{{ route('api.removeCafeItem', ['cafe' => $item->id]) }}')">حذف</button>
                                        </div>
                                        <div id="infoBox_{{ $item->id }}" class="hidden infoBox">
                                            <div>
                                                <label for="alt">تگ alt</label>
                                                <input type="text" id="alt_{{ $item->id }}" value="{{ $item->alt }}" />
                                            </div>
                                            <div>
                                                <label for="priority">اولویت</label>
                                                <input type="number" id="priority_{{ $item->id }}" value="{{ $item->priority }}" />
                                            </div>
                                            <div class="op">
                                                <button onclick="$('#opBox_{{ $item->id }}').removeClass('hidden'); $('#infoBox_{{ $item->id }}').addClass('hidden')" class="btn btn-danger">بازگشت</button>
                                                <button onclick="editIntroduce({{ $item->id }})" class="btn btn-success">اعمال تغییرات</button>
                                            </div>
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

        function save() {
            $.ajax({
                type: 'put',
                url: '{{ route('api.setAboutCafe') }}',
                data: {
                    'text': $("#about").val()
                },
                headers: {
                    "accept": "application/json"
                },
                success: function(res) {
                    if(res.status === "ok")
                        showSuccess('عملیات موردنظر با موفقیت انجام شد.');
                }
            })
        }

        function editIntroduce(id) {

            $.ajax({
                type: 'put',
                url: '{{ route('api.updateCafeItem') }}' + '/' + id,
                data: {
                    'priority': $("#priority_" + id).val(),
                    'alt': $("#alt_" + id).val()
                },
                headers: {
                    "accept": "application/json"
                },
                success: function(res) {
                    if(res.status === "ok") {
                        showSuccess('عملیات موردنظر با موفقیت انجام شد.');
                        $('#opBox_' + id).removeClass('hidden'); 
                        $('#infoBox_' + id).addClass('hidden');
                    }
                }
            });

        }

    </script>
@stop