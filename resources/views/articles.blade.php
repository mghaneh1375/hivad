@extends('layouts.siteLayout')

@section('header')
    @parent
    <style>
        .galleryImgText {
            font-size: 20px;
            position: absolute;
            width: 100%;
            bottom: -100px;
        }
        #galleryContent ul li {
            overflow: unset !important;
        }
        
        .galleryImgText .fancy {
            border: unset !important;
        }

        .galleryImgText .fancy {
            background: unset !important;
        }
    </style>
@stop

@section('menuId')'87665'@stop
@section('prefix')'article-'@stop
@section('menuName')'مقالات'@stop