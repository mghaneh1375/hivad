@extends('layouts.siteLayout')

@section('header')    
    @parent
    <style>
    
        .box {
            width: 600px;
            margin: 200px auto auto auto;
            display: flex;
            flex-direction: column;
            align-content: center;
            align-items: center;
        }

        .box img {
            margin: 0 auto 20px auto;
            width: 100px;
            height: 100px;
        }

        .box .content {
            padding: 10px 20px 10px 20px;
            background-color: white;
            box-shadow: 10px 10px 5px #aaaaaa;
            width: 100%;
        }

        .box .content p {
            font-size: 15px;
            line-height: 30px;
        }

        .box h2 {
            color: green;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .box a {
            margin-right: calc(100% - 170px);
            text-decoration: none;
            font-size: 15px;
        }

    </style>
@stop

@section('menuId')'54423'@stop
@section('prefix')'workTime-'@stop
@section('menuName')'ساعات-کاری'@stop

@section('customContent')
    <div class="box">

        <img src="{{ asset('assets/images/logo.png') }}" />
        <div class="content">
            <h2>پرداخت موفق</h2>
            <p>کد پیگیری: {{ $transaction->tracking_code }}</p>
            <p>کد مرجع: {{ $transaction->ref_num }}</p>
            <p>زمان: {{ \App\Http\Controllers\Controller::MiladyToShamsi2($transaction->created_at->timestamp) }}</p>
            <p>نام محصول: {{ $product }}</p>
            <a href="{{ route('home') }}">بازگشت به صفحه اصلی</a>
        </div>
    </div> 
@stop
    