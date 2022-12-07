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
                    <h1>{{ isset($article) ? 'ویرایش مقاله' : 'افزودن مقاله' }}</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; direction: rtl">

                    <div class="row">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="text-align: right">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <div class="col-xs-12" style="padding: 0">
                            @if(isset($article))
                                <div class="flex center">
                                    <img width="200px" src="{{ asset('Content/images/news/crop/' . $article->image) }}" />
                                </div>
                            @endif
                            <div style="margin-top: 10px;">
                                <form id="myForm" action="{{ isset($article) ? route('api.article.update', ['article' => $article->id]) : route('api.article.store')}}" method="post" enctype="multipart/form-data">

                                    @csrf

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        
                                        <input {{ isset($article) ? '' : 'required' }} type="file" name="img" id="imgInp">

                                        <div>
                                            <p>فایل مقاله</p>
                                            <input {{ isset($article) ? '' : 'required' }} type="file" name="f">
                                        </div>
                                        
                                        <div>
                                            <label for="priority">اولویت</label>
                                            <input value="{{ isset($article) ? $article->priority : old('priority') }}" type="number" required name="priority" id="priority" />
                                        </div>

                                        <div>
                                            <label for="alt_img">تگ alt</label>
                                            <input value="{{ isset($article) ? $article->alt_img : old('alt_img') }}" type="text" placeholder="این فیلد اختیاری است" name="alt_img" id="alt_img" />
                                        </div>
                                            
                                        <div>
                                            <label for="title">عنوان</label>
                                            <input value="{{ isset($article) ? $article->title : old('title') }}" type="text" name="title" id="title"/>
                                        </div>
                                        
                                        <div>
                                            <label for="tags">تگ های مقاله</label>
                                            <input value="{{ isset($article) ? $article->tags : old('tags') }}" type="text" name="tags" id="tags"/>
                                        </div>
                                        
                                        <div>
                                            <label for="keywords">کلید واژه ها</label>
                                            <input value="{{ isset($article) ? $article->keywords : old('keywords') }}" type="text" name="keywords" id="keywords"/>
                                        </div>
                                        
                                        <div>
                                            <label for="isImp">نمایش در صفحه نخست؟</label>
                                            <select name="is_imp" id="isImp">
                                                <option {{ (isset($article) && !$article->is_imp) || (old('is_imp') != null && !old('is_imp')) ? 'selected' : '' }} value="0">خیر</option>
                                                <option {{ (isset($article) && $article->is_imp) || (old('is_imp') != null && old('is_imp')) ? 'selected' : '' }} value="1">بله</option>
                                            </select>
                                        </div>

                                        
                                        <div>
                                            <label for="category_id">دسته موردنظر</label>
                                            <select name="category_id" id="category_id">
                                                @foreach ($categories as $category)
                                                    <option {{ (isset($article) && $article->category_id == $category->id) || (old('category_id') != null && old('category_id') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if(isset($article))
                                            <div>
                                                <label for="visibility">وضعیت نمایش</label>
                                                <select name="visibility" id="visibility">
                                                    <option {{ !$article->visibility ? 'selected' : '' }} value="0">مخفی</option>
                                                    <option {{ $article->visibility ? 'selected' : '' }} value="1">نمایش</option>
                                                </select>
                                            </div>
                                        @endif

                                        <div class="flex">
                                            <label for="digest">خلاصه مقاله</label>
                                            <textarea style="min-height: 200px;" name="digest" id="digest">{{ isset($article) ? $article->digest : old('digest') }}</textarea>
                                        </div>

                                        <div class="editor">
                                            <div id="toolbar-container"></div>
                                            @if(isset($article))
                                                <div id="description">{!!  $article->description !!}</div>
                                            @else
                                                <div id="description">{!! old('description') !!}</div>
                                            @endif
                                            
                                        </div>
                                        <textarea id="desc" class="hidden" name="description"></textarea>
                                    </div>
                        
                                    <div class="flex center gap10">
                                        <span onclick="document.location.href = '{{ route('articles.index') }}'" class="btn btn-danger">بازگشت</span>
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