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
                    <h1>{{ isset($product) ? 'ویرایش محصول' : 'افزودن محصول' }}</h1>
                </div>
            </div>

            @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" style="padding: 0">
                            @if(isset($product))
                                <div class="flex center">
                                    <img width="200px" src="{{ asset('Content/images/product/crop/' . $product->image) }}" />
                                </div>
                            @endif
                            <div style="margin-top: 10px;">
                                <form id="myForm" action="{{ isset($product) ? route('api.updateProduct', ['product' => $product->id]) : route('api.addProduct')}}" method="post" 
                                 enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        
                                        <div>
                                            <label for="title">عنوان</label>
                                            <input value="{{ isset($product) ? $product->title : '' }}" type="text" name="title" id="title"/>
                                        </div>

                                        <div>
                                            <p>تصویر محصول</p>
                                            <input {{ isset($product) ? '' : 'required' }} type="file" name="image" id="imgInp">
                                        </div>
                                        
                                        <div>
                                            <p>فایل محصول</p>
                                            <input {{ isset($product) ? '' : 'required' }} type="file" name="file">
                                        </div>

                                        <div>
                                            <label for="priority">اولویت</label>
                                            <input value="{{ isset($product) ? $product->priority : '' }}" type="number" required name="priority" id="priority" />
                                        </div>

                                        <div>
                                            <label for="alt">تگ alt</label>
                                            <input value="{{ isset($product) ? $product->alt : '' }}" type="text" placeholder="این فیلد اختیاری است" name="alt" id="alt" />
                                        </div>
                                        
                                        <div>
                                            <label for="keywords">کلمات کلیدی</label>
                                            <input value="{{ isset($product) ? $product->keywords : '' }}" type="text" placeholder="این فیلد اختیاری است" name="keywords" id="keywords" />
                                        </div>
                                        
                                        <div>
                                            <label for="price">قیمت</label>
                                            <input value="{{ isset($product) ? $product->price : '' }}" type="number" name="price" id="price"/>
                                        </div>
                                        
                                        <div>
                                            <label for="isImp">نمایش در صفحه نخست؟</label>
                                            <select name="is_imp" id="isImp">
                                                <option {{ isset($product) && !$product->is_imp ? 'selected' : '' }} value="0">خیر</option>
                                                <option {{ isset($product) && $product->is_imp ? 'selected' : '' }} value="1">بله</option>
                                            </select>
                                        </div>

                                        @if(isset($product))
                                            <div>
                                                <label for="visibility">وضعیت نمایش</label>
                                                <select name="visibility" id="visibility">
                                                    <option {{ !$product->visibility ? 'selected' : '' }} value="0">مخفی</option>
                                                    <option {{ $product->visibility ? 'selected' : '' }} value="1">نمایش</option>
                                                </select>
                                            </div>
                                        @endif

                                        <div class="flex">
                                            <label for="digest">خلاصه توضیح</label>
                                            <textarea style="min-height: 200px;" name="digest" id="digest">{{ isset($product) ? $product->digest : '' }}</textarea>
                                        </div>

                                        <div class="editor">
                                            <div id="toolbar-container"></div>
                                            @if(isset($product))
                                                <div id="description">{!!  $product->description !!}</div>
                                            @else
                                                <div id="description"></div>
                                            @endif
                                            
                                        </div>
                                        <textarea id="desc" class="hidden" name="description"></textarea>
                                    </div>
                        

                                    <div class="flex center gap10">
                                        <span onclick="document.location.href = '{{ route('manageProducts') }}'" class="btn btn-danger">بازگشت</span>
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