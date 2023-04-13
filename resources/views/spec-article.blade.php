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

@section('customContent')
    <div id="dialogContent">

        <div class="news-header" id="newsWidget">
            <div>
                <span id="newsInfo">
                    <a><h3>{{$article->title}}</h3></a>
                    {!! $article->digest !!}
                </span>

                <a class="img_link_wrapper">
                    <div>
                        <img src="{{ asset('Content/images/news/crop/' . $article->image) }}"
                            alt="{{$article->alt}}" />
                    </div>
                </a>

            </div>
            
            <div>
                @if(str_contains($article->file, '.mp4') || 
                    str_contains($article->file, '.mov') || 
                    str_contains($article->file, '.mkv') || 
                    str_contains($article->file, '.flv') ||
                    str_contains($article->file, '.m4v') ||
                    str_contains($article->file, '.mpeg') ||
                    str_contains($article->file, '.avi') ||
                    str_contains($article->file, '.mkv'))
                    <video src="{{ asset('storage/articles/' . $article->file) }}" width="100%" controls>        
                        Your browser does not support the video tag.
                    </video>
                @elseif(str_contains($article->file, '.ogg') || 
                    str_contains($article->file, '.wav') || 
                    str_contains($article->file, '.mp3'))
                    <audio controls>
                        <source src="{{ asset('storage/articles/' . $article->file) }}">
                        Your browser does not support the audio element.
                    </audio>
                @elseif(str_contains($article->file, '.pdf'))
                    <object data="{{ asset('storage/articles/' . $article->file) }}" type="application/pdf" width="100%" height="1000px">
                        <p>Unable to display PDF file. <a href="{{ asset('storage/articles/' . $article->file) }}">Download</a> instead.</p>
                    </object>
                @else
                    <a download href="{{ asset('storage/articles/' . $article->file) }}">دانلود فایل محصول</a>
                @endif
            </div>
        </div>

    </div>
@stop