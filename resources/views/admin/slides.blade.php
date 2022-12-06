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
                    <h1>مدیریت اسلایدبار</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12">
                            @foreach($slides as $slide)
                                <div style="min-height: 250px" class="column col-xs-12 col-lg-6 myContainer" id="item_{{ $slide->id }}">
                                    <img src="{{URL::asset('Content/images/GalleryPictures/crop/'.$slide->image)}}" alt="{{ $slide->alt }}" style="width:100%; height: 100%">
                                    <div class="overlay">
                                        <div class="opBox" id="opBox_{{ $slide->id }}">
                                            <button class="btn btn-primary" onclick="$('#opBox_{{ $slide->id }}').addClass('hidden'); $('#infoBox_{{ $slide->id }}').removeClass('hidden')">مشاهده اطلاعات</button>
                                            <button class="btn btn-danger" onclick="remmoveModal('item', {{$slide->id}}, '{{ route('api.removeSlide', ['slidebar' => $slide->id]) }}')">حذف</button>
                                        </div>
                                        <div id="infoBox_{{ $slide->id }}" class="hidden infoBox">
                                                <div>
                                                    <label for="alt">تگ alt</label>
                                                    <input type="text" id="alt_{{ $slide->id }}" value="{{ $slide->alt }}" />
                                                </div>
                                                <div>
                                                    <label for="priority">اولویت</label>
                                                    <input type="number" id="priority_{{ $slide->id }}" value="{{ $slide->priority }}" />
                                                </div>

                                                <div>
                                                    <label for="header">عنوان</label>
                                                    <input type="text" id="header_{{ $slide->id }}" value="{{ $slide->header }}" />
                                                </div>
                                                
                                                <div>
                                                    <label for="description">توضیح</label>
                                                    <textarea type="text" id="description_{{ $slide->id }}">{{ $slide->description }}</textarea>
                                                </div>

                                                <div>
                                                    <label for="visibility">وضعیت نمایش</label>
                                                    <select id="visibility_{{ $slide->id }}">
                                                        @if($slide->visibility == 1)
                                                            <option value="0">مخفی</option>
                                                            <option selected value="1">نمایش</option>
                                                        @else
                                                            <option selected value="0">مخفی</option>
                                                            <option value="1">نمایش</option>
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="op">
                                                    <button onclick="$('#opBox_{{ $slide->id }}').removeClass('hidden'); $('#infoBox_{{ $slide->id }}').addClass('hidden')" class="btn btn-danger">بازگشت</button>
                                                    <button onclick="editItem({{ $slide->id }})" class="btn btn-success">اعمال تغییرات</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-xs-12" style="border: solid;">
                            
                            <div style="margin-top: 10px;">
                                <form action="{{route('api.addSlide')}}" method="post"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}

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
                                            
                                        <div>
                                            <label for="header">عنوان</label>
                                            <input type="text" name="header" id="header" />
                                        </div>
                                        
                                        <div>
                                            <label for="description">توضیح</label>
                                            <textarea type="text" name="description"></textarea>
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>

    <script>
        
        function editItem(id) {

            $.ajax({
                type: 'put',
                url: '{{ route('api.updateSlide') }}' + '/' + id,
                data: {
                    'priority': $("#priority_" + id).val(),
                    'alt': $("#alt_" + id).val(),
                    'header': $("#header_" + id).val(),
                    'visibility': $('#visibility_' + id).val(),
                    'description': $('#description_' + id).val()
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
