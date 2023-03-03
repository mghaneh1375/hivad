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
                    <h1>مدیریت گالری</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12">
                            @foreach($galleries as $gallery)
                                <div style="min-height: 250px" class="column col-xs-12 col-lg-6 myContainer" id="item_{{ $gallery->id }}">
                                    <img src="{{URL::asset('Content/images/GalleryPictures/crop/'.$gallery->image)}}" alt="{{ $gallery->alt }}" style="width:100%; height: 100%">
                                    <div class="overlay">
                                        <div class="opBox" id="opBox_{{ $gallery->id }}">
                                            <button class="btn btn-primary" onclick="$('#opBox_{{ $gallery->id }}').addClass('hidden'); $('#infoBox_{{ $gallery->id }}').removeClass('hidden')">مشاهده اطلاعات</button>
                                            <button class="btn btn-danger" onclick="remmoveModal('item', {{$gallery->id}}, '{{ route('api.removeGallery', ['gallery' => $gallery->id]) }}')">حذف</button>
                                        </div>
                                        <div id="infoBox_{{ $gallery->id }}" class="hidden infoBox">
                                                <div>
                                                    <label for="alt_{{ $gallery->id }}">تگ alt</label>
                                                    <input type="text" id="alt_{{ $gallery->id }}" value="{{ $gallery->alt }}" />
                                                </div>
                                                <div>
                                                    <label for="priority_{{ $gallery->id }}">اولویت</label>
                                                    <input type="number" id="priority_{{ $gallery->id }}" value="{{ $gallery->priority }}" />
                                                </div>

                                                <div>
                                                    <label for="title_{{ $gallery->id }}">عنوان</label>
                                                    <input type="text" id="title_{{ $gallery->id }}" value="{{ $gallery->title }}" />
                                                </div>

                                                <div>
                                                    <label for="isImp_{{ $gallery->id }}">نمایش در صفحه نخست؟</label>
                                                    <select id="isImp_{{ $gallery->id }}">
                                                        @if($gallery->is_imp == 1)
                                                            <option value="0">خیر</option>
                                                            <option selected value="1">بله</option>
                                                        @else
                                                            <option selected value="0">خیر</option>
                                                            <option value="1">بله</option>
                                                        @endif
                                                    </select>
                                                </div>

                                                <div>
                                                    <label for="visibility_{{ $gallery->id }}">وضعیت نمایش</label>
                                                    <select id="visibility_{{ $gallery->id }}">
                                                        @if($gallery->visibility == 1)
                                                            <option value="0">مخفی</option>
                                                            <option selected value="1">نمایش</option>
                                                        @else
                                                            <option selected value="0">مخفی</option>
                                                            <option value="1">نمایش</option>
                                                        @endif
                                                    </select>
                                                </div>

                                                <div>
                                                    <label for="category_id_{{ $gallery->id }}">دسته موردنظر</label>
                                                    <select id="category_id_{{ $gallery->id }}">
                                                        @foreach ($categories as $category)
                                                            <option {{ $category->id == $gallery->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="op">
                                                    <button onclick="$('#opBox_{{ $gallery->id }}').removeClass('hidden'); $('#infoBox_{{ $gallery->id }}').addClass('hidden')" class="btn btn-danger">بازگشت</button>
                                                    <button onclick="editItem({{ $gallery->id }})" class="btn btn-success">اعمال تغییرات</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-xs-12" style="border: solid;">
                            
                            @if($errors->any())
                                {{ implode('', $errors->all('<div>:message</div>')) }}
                            @endif

                            <div style="margin-top: 10px;">
                                <form action="{{route('api.addGallery')}}" method="post" enctype="multipart/form-data">
                                    
                                    @csrf

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
                                            <label for="title">عنوان</label>
                                            <input type="text" name="title" id="title"/>
                                        </div>
                                        
                                        <div>
                                            <label for="isImp">نمایش در صفحه نخست؟</label>
                                            <select name="is_imp" id="isImp">
                                                <option value="0">خیر</option>
                                                <option value="1">بله</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="category_id">دسته موردنظر</label>
                                            <select name="category_id" id="category_id">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
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
                url: '{{ route('api.updateGallery') }}' + '/' + id,
                data: {
                    'priority': $("#priority_" + id).val(),
                    'alt': $("#alt_" + id).val(),
                    'title': $("#title_" + id).val(),
                    'visibility': $('#visibility_' + id).val(),
                    'is_imp': $('#isImp_' + id).val(),
                    'category_id': $('#category_id_' + id).val(),
                },
                titles: {
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