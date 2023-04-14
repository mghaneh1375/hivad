@extends('layouts.siteLayout')

@section('header')
    @parent
    
    <style>
        .catblurb p {
            top: -50% !important;
            left: -50% !important;
            height: 100% !important;
            display: unset !important;
        }
        
        .catblurb:hover p {
            transform: translate(50%,50%) scale(.8) !important;
        }
    </style>
@stop

@section('menuId')'83465'@stop
@section('prefix')'spec-category-'@stop
@section('setRefId') refId = '{{ $category->id }}'; @stop
@section('menuName')'مقالات {{ $category->title }}'@stop