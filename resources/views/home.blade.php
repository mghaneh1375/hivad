@extends('layouts.siteLayout')

@section('header')
    @parent

    <style>

        .wrapper_Col > #newsWidget {
            display: flex !important;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .wrapper_Col > #newsWidget > div {
            position: relative !important;
            right: unset !important;
            top: unset !important;
            display: flex !important;
            flex-direction: column;
            height: 370px;
            width: 300px;
            padding: 0 !important;
        }

        .wrapper_Col > #newsWidget > div img {
            max-height: 150px !important;
            width: auto;
        }
        .wrapper_Col > #newsWidget #newsInfo {
            padding: 10px;
            padding-top: 20px;
        }
        .wrapper_Col > #newsWidget #newsInfo .info_wrapper_wrapper {
            left: 0;
            top: -11px !important;
        }
        .wrapper_Col > #newsWidget #newsInfo .span_loaddingImg {
            display: none;
        }        
        
    </style>
@stop

@section('menuId')'-1'@stop
@section('prefix')''@stop
@section('menuName')'خانه'@stop
@section('title')هیواد | خانه@stop
