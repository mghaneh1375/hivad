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

@section('menuId')'39846'@stop
@section('prefix')'people-'@stop
@section('menuName')'درباره-متخصصین'@stop
@section('title')درباره متخصصین@stop
