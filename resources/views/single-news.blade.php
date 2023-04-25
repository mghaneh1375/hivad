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
    </style>

@stop

@section('menuId')'87665'@stop
@section('prefix')'single-news-'@stop
@section('menuName')'مقالات'@stop
@section('title')اخبار | {{ $news->title }}@stop

@section('customContent')

    <div id="dialogContent">

        <div class="news-header" id="newsWidget">
            <div>
                <span id="newsInfo">
                    <span class="newsDate">{{$d}}</span>

                    <a data-newsid="9399"><h3>{{$news->title}}</h3></a>
                    <p>{{$news->digest}}</p>
                </span>
                    
                <div class="info_wrapper_wrapper">
                    <div class="tagList">
                        @foreach (explode(',', $news->tags) as $tag)
                            # {{ $tag }}
                        @endforeach
                    </div>
                </div>

                <a class="img_link_wrapper" data-temp='NewsText' data-newsid="9399">
                    <span style="display:block;">
                            <img src="{{ asset('Content/images/news/crop/' . $news->image) }}"
                                alt="{{$news->alt}}" />
                    </span>
                </a>

            </div>

        </div>
        
        <div class="news-content">                 
                {!! $news->description !!}
        </div>

    </div>
@stop