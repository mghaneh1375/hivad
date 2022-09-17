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
                    <h1>افزودن فیلم</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" style="border: solid;">
                            
                            <div style="margin-top: 10px;">
                                <form action="{{route('api.addVideo')}}" method="post" 
                                 enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kind" value="save">

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        
                                        <div>
                                            <label for="title">عنوان</label>
                                            <input type="text" name="title" id="title"/>
                                        </div>

                                        <div>
                                            <label for="catId">دسته</label>
                                            <select name="cat_id" id="catId">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label for="imgInp">فایل تصویر preview</label>
                                            <input type="file" name="image" required id="imgInp">
                                        </div>
                                        
                                        <div>
                                            <label for="file">فایل ویدیو</label>
                                            <input type="file" name="file" required id="file">
                                        </div>
                                        

                                        <div>
                                            <label for="priority">اولویت</label>
                                            <input type="number" required name="priority" id="priority" />
                                        </div>
                                        <div>
                                            <label for="alt">تگ alt</label>
                                            <input type="text" placeholder="این فیلد اختیاری است" name="alt" id="alt" />
                                        </div>
                                            
                                        
                                        <div>
                                            <label for="isImp">نمایش در صفحه نخست؟</label>
                                            <select name="is_imp" id="isImp">
                                                <option value="0">خیر</option>
                                                <option value="1">بله</option>
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