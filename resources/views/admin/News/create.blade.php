@extends('layouts.structure')

@section('header')
    @parent
    <script>
        var UploadURL = '{{ route('api.uploadImg') }}';
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/decoupled-document/ckeditor.js"></script>
    <script src="{{asset('assets/js/ckeditor.js?v=2.2')}}"></script>

    <style>

        #myForm > div > div {
            width: calc(100% - 20px);
        }

        #myForm > div > div:not(.editor) {
            display: flex;
        }

        #myForm > div > div > label {
            width: 150px;
        }

        #myForm > div > div > textarea,
        #myForm > div > div > input,
        #myForm > div > div > select {
            width: calc(100% - 170px);
        }

    </style>

@stop

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    <h1>{{ isset($news) ? 'ویرایش خبر' : 'افزودن خبر' }}</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" style="padding: 0">
                            @if(isset($news))
                                <div class="flex center">
                                    <img width="200px" src="{{ asset('Content/images/news/crop/' . $news->image) }}" />
                                </div>
                            @endif
                            <div style="margin-top: 10px;">
                                <form id="myForm" action="{{ isset($news) ? route('api.updateNews', ['news' => $news->id]) : route('api.addNews')}}" method="post" 
                                 enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        <input {{ isset($news) ? '' : 'required' }} type="file" name="image" id="imgInp">
                                        <div>
                                            <label for="priority">اولویت</label>
                                            <input value="{{ isset($news) ? $news->priority : '' }}" type="number" required name="priority" id="priority" />
                                        </div>
                                        <div>
                                            <label for="alt">تگ alt</label>
                                            <input value="{{ isset($news) ? $news->alt : '' }}" type="text" placeholder="این فیلد اختیاری است" name="alt" id="alt" />
                                        </div>
                                            
                                        <div>
                                            <label for="title">عنوان</label>
                                            <input value="{{ isset($news) ? $news->title : '' }}" type="text" name="title" id="title"/>
                                        </div>
                                        
                                        <div>
                                            <label for="tags">تگ های اخبار</label>
                                            <input value="{{ isset($news) ? $news->tags : '' }}" type="text" name="tags" id="tags"/>
                                        </div>
                                        
                                        <div>
                                            <label for="isImp">نمایش در صفحه نخست؟</label>
                                            <select name="is_imp" id="isImp">
                                                <option {{ isset($news) && !$news->is_imp ? 'selected' : '' }} value="0">خیر</option>
                                                <option {{ isset($news) && $news->is_imp ? 'selected' : '' }} value="1">بله</option>
                                            </select>
                                        </div>

                                        @if(isset($news))
                                            <div>
                                                <label for="visibility">وضعیت نمایش</label>
                                                <select name="visibility" id="visibility">
                                                    <option {{ !$news->visibility ? 'selected' : '' }} value="0">مخفی</option>
                                                    <option {{ $news->visibility ? 'selected' : '' }} value="1">نمایش</option>
                                                </select>
                                            </div>
                                        @endif

                                        <div class="flex">
                                            <label for="digest">خلاصه خبر</label>
                                            <textarea style="min-height: 200px;" name="digest" id="digest">{{ isset($news) ? $news->digest : '' }}</textarea>
                                        </div>

                                        <div class="editor">
                                            <div id="toolbar-container"></div>
                                            @if(isset($news))
                                                <div id="description">{!!  $news->description !!}</div>
                                            @else
                                                <div id="description"></div>
                                            @endif
                                            
                                        </div>
                                        <textarea id="desc" class="hidden" name="description"></textarea>
                                    </div>
                        

                                    <div class="flex center gap10">
                                        <span onclick="document.location.href = '{{ route('manageNews') }}'" class="btn btn-danger">بازگشت</span>
                                        <span class="btn green" id="saveBtn">ذخیره</span>
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