@extends('layouts.structure')

@section('header')
    @parent
    <script>
        var UploadURL = '{{ route('api.uploadImg') }}';
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/decoupled-document/ckeditor.js"></script>
    <script src="{{asset('assets/js/ckeditor.js?v=2.2')}}"></script>
    <link rel="stylesheet" href="{{asset('css/createStyle.css')}}" />
@stop

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    @if(isset($video))
                        <h1>ویرایش فیلم {{ $video->title }}</h1>
                    @else
                        <h1>افزودن فیلم</h1>
                    @endif
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

            
                    @if($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif

                    <div class="row">

                        <div class="col-xs-12" style="border: solid;">
                            
                            <div style="margin-top: 10px;">
                                <form id="myForm" action="{{isset($video) ? route('api.updateVideo', ['video' => $video->id]) : route('api.addVideo')}}" method="post" 
                                 enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        
                                        <div>
                                            <label for="title">عنوان</label>
                                            <input value="{{ isset($video) ? $video->title : '' }}" type="text" name="title" id="title"/>
                                        </div>

                                        <div>
                                            <label for="catId">دسته</label>
                                            <select name="cat_id" id="catId">
                                                @foreach($categories as $category)
                                                    <option {{ isset($video) && $video->cat_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if(isset($video))
                                            <p>تصویر پیش نمایش کنونی</p>
                                            <img width="200px" src={{ asset('Content/images/GalleryPictures/crop/' . $video->image) }} />
                                        @endif

                                        <div>
                                            
                                            @if(isset($video))
                                                <label for="imgInp"> فایل تصویر پیش نمایش جدید برای تغییر</label>
                                            @else
                                                <label for="imgInp">فایل تصویر پیش نمایش</label>
                                            @endif

                                            <input type="file" name="image" {{ isset($video) ? '' : 'required' }} id="imgInp">
                                        </div>
                                        
                                        @if(isset($video))
                                            <p>ویدیو کنونی</p>
                                            <video width='300px' controls='' src='{{ asset('Content/images/videos/' . $video->file) }}'>
                                                    Your browser does not support the video tag.
                                            </video>
                                        @endif

                                        <div>
                                            
                                            @if(isset($video))
                                                <label for="file">فایل ویدیو جدید برای تغییر</label>
                                            @else
                                                <label for="file">فایل ویدیو</label>
                                            @endif

                                            <input type="file" name="file" {{ isset($video) ? '' : 'required' }} id="file">
                                        </div>
                                        

                                        <div>
                                            <label for="priority">اولویت</label>
                                            <input value="{{ isset($video) ? $video->priority : '' }}" type="number" required name="priority" id="priority" />
                                        </div>
                                        <div>
                                            <label for="alt">تگ alt</label>
                                            <input value="{{ isset($video) ? $video->alt : '' }}" type="text" placeholder="این فیلد اختیاری است" name="alt" id="alt" />
                                        </div>
                                            
                                        
                                        <div>
                                            <label for="isImp">نمایش در صفحه نخست؟</label>
                                            <select name="is_imp" id="isImp">
                                                @if(isset($video) && !$video->is_imp)
                                                    <option value="0">خیر</option>
                                                    <option value="1">بله</option>
                                                @else
                                                    <option value="0">خیر</option>
                                                    <option selected value="1">بله</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="editor">
                                            <div id="toolbar-container"></div>
                                            @if(isset($video))
                                                <div id="description">{!!  $video->description !!}</div>
                                            @else
                                                <div id="description"></div>
                                            @endif
                                            
                                        </div>
                                        <textarea id="desc" class="hidden" name="description"></textarea>

                                    </div>
                        

                                    <div class="flex center gap10">
                                        <span onclick="document.location.href = '{{ route('manageVideo') }}'" class="btn btn-danger">بازگشت</span>
                                        <span id="saveBtn" class="btn green">ذخیره</span>
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

    <script src="{{asset('assets/js/initCKs.js?v=2.3')}}"></script>
    <script>
        $(document).ready(function () {
            initCK('{{ csrf_token() }}');
            $("#saveBtn").on('click', function() {
                $("#desc").val($("#description").html());
                $("#myForm").submit();
            });
        });
    </script>
    
@stop