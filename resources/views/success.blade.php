<html>

    <head>
        
        <style>
            
            @font-face {
                font-family: 'IRANSansWeb_FaNum';
                src: url("{{ asset('assets/fonts/IRANSansWeb\(FaNum\).eot') }}"),
                    url("{{ asset('assets/fonts/IRANSansWeb\(FaNum\).eot?#iefix') }}") format("embedded-opentype"),
                    url("{{ asset('assets/fonts/IRANSansWeb\(FaNum\).woff2') }}") format("woff2"),
                    url("{{ asset('assets/fonts/IRANSansWeb\(FaNum\).woff') }}") format("woff"),
                    url("{{ asset('assets/fonts/IRANSansWeb\(FaNum\).ttf') }}") format("truetype");
                font-weight: normal
            }

            body {
                background-color: #ccc;
                font-family: IRANSansWeb_FaNum;
                direction: rtl;
            }

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
                color: green;
            }

            .box a {
                margin-right: calc(100% - 170px);
                text-decoration: none;
            }

        </style>

    </head>

    <body>

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

    </body>

</html>
    