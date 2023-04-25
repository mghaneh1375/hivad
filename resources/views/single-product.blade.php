@extends('layouts.siteLayout')

@section('header')
    @parent
        
    <style>
        #loading-img {
            display: none;
        }
        div#dialogContent {
            width: unset !important;
            max-width: unset !important;
            padding: 20px;
            overflow-x: hidden;
        }
        
        .span_loaddingImg {
            display: none !important;
        }

        #dialogContent {
            height: auto;
            direction: rtl;
            background: white;
        }

        .likeProduct {
            float: right;
            top: 64px;
        }

        .buy-btn {
            background-color: #b7985b;
            border: 1px solid #b7985b;
            border-radius: 10px;
            padding: 10px 20px 10px 20px;
            text-decoration: none;
            color: white;
        }
    </style>
@stop

@section('menuId')'762'@stop
@section('prefix')'single-news-'@stop
@section('menuName')'فروشگاه'@stop
@section('title')محصولات | {{ $product->title }}@stop

@section('customContent')
    <div id="dialogContent">

        <div class="news-header" id="newsWidget">
            <div>
                <span id="newsInfo">
                    <a><h3>{{$product->title}}</h3></a>
                    {!! $product->description !!}
                </span>

                <a class="img_link_wrapper">
                    <div>
                        <img src="{{ asset('Content/images/products/crop/' . $product->image) }}"
                            alt="{{$product->alt}}" />
                    </div>
                </a>

            </div>
            
            
            @if(Auth::check() && !$can_buy)
                <div>
                    @if(str_contains($product->file, '.mp4') || 
                        str_contains($product->file, '.mov') || 
                        str_contains($product->file, '.mkv') || 
                        str_contains($product->file, '.flv') ||
                        str_contains($product->file, '.m4v') ||
                        str_contains($product->file, '.mpeg') ||
                        str_contains($product->file, '.avi') ||
                        str_contains($product->file, '.mkv'))
                        <video src="{{ asset('Content/images/products/crop/' . $product->file) }}" width="100%" controls>        
                            Your browser does not support the video tag.
                        </video>
                    @elseif(str_contains($product->file, '.ogg') || 
                        str_contains($product->file, '.wav') || 
                        str_contains($product->file, '.mp3'))
                        <audio controls>
                            <source src="{{ asset('Content/images/products/crop/' . $product->file) }}">
                            Your browser does not support the audio element.
                        </audio>
                    @elseif(str_contains($product->file, '.pdf'))
                        <object data="{{ asset('Content/images/products/crop/' . $product->file) }}#toolbar=0" type="application/pdf" width="100%" height="1000px">
                            <p>Unable to display PDF file. <a href="{{ asset('Content/images/products/crop/' . $product->file) }}">Download</a> instead.</p>
                        </object>
                    @else
                        <a download href="{{ asset('Content/images/products/crop/' . $product->file) }}">دانلود فایل محصول</a>
                    @endif
                </div>
            @else
                <div style="display: flex; flex-direction: row; justify-content: space-between">
                    
                    <p>
                        <span>قیمت محصول: </span>
                        <span>{{ number_format($product->price, 0) . ' تومان' }}</span>
                    </p>

                    <div>
                        @if(Auth::check())
                            @if($can_buy)
                                <a class="buy-btn" href="{{ route('payment', ['product' => $product->id]) }}">خرید محصول</a>
                            @endif
                        @else
                            <button onclick="$('#signInSignUpBtn').click()">ورود برای خرید محصول</button>
                        @endif
                    </div>
                </div>
            @endif
        </div>

    </div>
@stop