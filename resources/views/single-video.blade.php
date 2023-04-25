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

@section('menuId')'29270'@stop
@section('prefix')'single-news-'@stop
@section('menuName')'گالری-ویدیو'@stop
@section('title')گالری ویدیو | {{ $video->title }}@stop



@section('customContent')
    <div id="dialogContent">

        <div class="news-header" id="newsWidget">
            <div>
                <span id="newsInfo">
                    <a><h3>{{$video->title}}</h3></a>
                    {!! $video->description !!}
                </span>

                <a class="img_link_wrapper">
                    <div>
                        <img src="{{ asset('Content/images/GalleryPictures/crop/' . $video->image) }}"
                            alt="{{$video->alt}}" />
                    </div>
                </a>

            </div>
            
            <div>
                <video src="{{ $video->file }}" width="100%" controls>        
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>

    </div>
@stop
{{-- 
<div id="dialogContent">

    <div class="news-header" id="newsWidget">
        <div>
            <span id="newsInfo">
                <a data-newsid="9399"><h3>{{$video->title}}</h3></a>
                <video width='100%' controls='' src='{{ $video->file }}'>
                        Your browser does not support the video tag.
                </video>
            </span>
        </div>

    </div>
    
    @if($video->description != null && $video->description != "")
        <div class="news-content">
            <p>{!! $video->description !!}</p>
        </div>
    @endif

    @if($video->tags != null)
        <div class="tagList">
            {{$video->tags}}
        </div>
    @endif
</div> --}}