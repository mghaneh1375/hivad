<!DOCTYPE html>

<html>

<head>

    <link href="{{ asset('assets/css/siteLayout95.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/css_underDesign.css') }}" rel="stylesheet" />
    
    <link href="{{ asset('assets/css/iziToast.min.css') }}" rel="stylesheet" />

	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    
    <script type="text/javascript">
        const ACTIVATE_ROUTE = '{{ route('activateAccount') }}';
        const SIGNUP_ROUTE = '{{ route('signUp') }}';
        const EDIT_ROUTE = '{{ route('edit') }}';
        const CHANGE_PASS_ROUTE = '{{ route('changePass') }}';
        const SIGNIN_ROUTE = '{{ route('signIn') }}';
    </script>


    @section('header')

        <!-- Meta Data -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="keywords" content="" />
        <link rel="shortcut icon" href="/Content/base/dynamic/shopping762/favIcon.jpg?ver=1">
        <meta name="viewport" content="initial-scale=1 ,width=device-width, user-scalable=yes">
        <meta property="og:locale" content="fa_IR" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="/Content/base/dynamic/shopping762/favIcon.jpg?ver=1" />
        <meta name="robots" content="index, follow">
        <meta name="language" content="fa">

        
        <title>@yield('title')</title>
        <meta name="description" content="@yield('title')" />
        <meta property="og:title" content="@yield('title')" />
        <meta property="og:site_name" content="@yield('title')" />

        <script>
        
            var menuName = @yield('menuName');
            var prefix = @yield('prefix');
            var menuId = @yield('menuId');
            var refId = undefined;

            @yield('setRefId')
            
            var htmlPrefix = @yield('htmlPrefix', 'null');
            if(htmlPrefix == null || htmlPrefix == 'null')
                htmlPrefix = undefined;

            var dynamicFields = {
                platform7Permission: { AmazingOffer: 'False', PageProduct1 : 'True'}  ,
                    userExmape:'',
                OnlineFoodShopping: 'False',
                Root: '',
                UserMembershipFee: '0',
                FormData: { logID: '', formID: '', boxID: '', currentUser: '', o: ''},
                LoadFunction: 'MasterPageLoad',
                AddminPermission: 'False',
                prefix: prefix,
                refId: refId,
                html_prefix: htmlPrefix,
                bascketData: '', PhoneNumberRegistration: 'False', IsPlatform7 : 'False',
                WebsiteID:762, menuID: menuId, menuName: menuName,
                userID: '', haspageContent: '', adminHaspageContent: '', hasFooterContent: '', 
                SeoLinkList: '[]', BaseMenuID: menuId, IsProfileMenu: 'False', 
                DigitalShopping: 'False', 
            }

        </script>

    @show

</head>

<body class="ManagednewTab" data-menuid=@yield('menuId') data-expire="False" data-wid="762" data-ap="False" data-isprofilemenu="false" class="noLogin">

    <div id="msScroll_wrapper">

        @include('layouts.navbar')

        <div id="container_wrapper">
            <div id="container">


                <main id="mainContent">
                    <div class="mainContent-wrapper">
                        @yield('customContent')
                    </div>
                    <div class="textContent first"></div>
                    <div id="siteMap"><span>@yield('title')</span></div>
                    <div id="wrapper-main-page" class="textContent" data-menuid="">
                    </div>
                </main>
            </div>
        </div>

        <div id="pageCover"></div>
        @include('layouts.footer')

    </div>

    @include('layouts.progress')

    <script src="{{ asset('assets/js/utilities.js') }}"></script>
    <script src="{{ asset('assets/js/siteLayout.min.js?v=1.3') }}" defer></script>
    <script src="{{ asset('assets/js/js_underDesign.js') }}" defer></script>
    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/commonJS.js') }}"></script>

    @yield('customModal')
    @yield('customJS')


    <style>
        #loading {
            position: fixed;
            width: 100%;
            height: 100vh;
            background: rgba(255, 255, 255, 0.37) url("loader.gif") no-repeat center
                center;
            z-index: 99999999;
            top: 0;
            left: 0;
        }
        .my-fixed {
            position: fixed;
            z-index: 8;
        }
        .loaderStyle {
            position: fixed;
            z-index: 990000;
            /*makehigherthanwhateverisonthepage*/
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            width: 50px;
            height: 50px;
            border: 5px solid #fff;
            border-bottom-color: #c59358;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        .backOfLoader {
            left: 0;
            top: 0;
            opacity: 0.5;
            z-index: 99;
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: black;
        }

    </style>
    <div id="loading" class="hidden">
        <div class="backOfLoader">
            <span class=" loaderStyle"></span>
        </div>
    </div>
</body>
</html>

