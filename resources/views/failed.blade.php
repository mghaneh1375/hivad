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

        .box h2 {
            color: red;
        }

        .box a {
            margin-right: calc(100% - 170px);
            text-decoration: none;
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
                <h2>پرداخت ناموفق</h2>
                
                @if(isset($transaction))
                    <p>در صورت کم شدن مبلغ از حسابتان، تا 48 ساعت آینده مبلغ به حسابتان عودت داده خواهد شد</p>
                @endif
                
                @if(isset($transaction))
                    <p>کد پیگیری: {{ $transaction->tracking_code }}</p>
                    <p>کد مرجع: {{ $transaction->additional_id }}</p>
                    <p>زمان: {{ \App\Http\Controllers\Controller::MiladyToShamsi2($transaction->created_at->timestamp) }}</p>
                    @if(isset($msg))
                        <p>{{ $msg }}</p>
                    @endif
                @else
                    <p>شما قبلا این محصول را خریداری کرده اید</p>
                @endif
                <a href="{{ route('home') }}">بازگشت به صفحه اصلی</a>
            </div>

    </div>
@stop

