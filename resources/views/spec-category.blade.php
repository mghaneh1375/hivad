@extends('layouts.siteLayout')

@section('header')
    @parent
@stop

@section('menuId')'83465'@stop
@section('prefix')'spec-category-'@stop
@section('setRefId') refId = '{{ $category->id }}'; @stop
@section('menuName')'گالری-تصاویر'@stop
@section('title')مقالات | {{ $category->title }}@stop