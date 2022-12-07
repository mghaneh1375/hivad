<!DOCTYPE html>

<html>

<head>
    
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
        <link href="{{ asset('assets/css/siteLayout95.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/css_underDesign.css') }}" rel="stylesheet" />
        
        <link href="{{ asset('assets/css/iziToast.min.css') }}" rel="stylesheet" />
    
        
        <title>@yield('title')</title>
        <meta name="description" content="@yield('title')" />
        <meta property="og:title" content="@yield('title')" />
        <meta property="og:site_name" content="@yield('title')" />

        <script>
        
            var menuName = @yield('menuName');
            var prefix = @yield('prefix');
            var menuId = @yield('menuId');
            
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

<body data-menuid=@yield('menuId') data-expire="False" data-wid="762" data-ap="False" data-isprofilemenu="false" class="noLogin">

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

    <script src="{{ asset('assets/js/siteLayout.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/js_underDesign.js') }}" defer></script>
    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/commonJS.js') }}"></script>

    <script>
        function showErr(msg) {
            s = {
                rtl: true,
                class: "iziToast-" + "danger",
                title: "ناموفق",
                message: msg,
                animateInside: !1,
                position: "topRight",
                progressBar: !1,
                icon: 'ri-close-fill',
                timeout: 3200,
                transitionIn: "fadeInLeft",
                transitionOut: "fadeOut",
                transitionInMobile: "fadeIn",
                transitionOutMobile: "fadeOut",
                color: "red",
                };
            iziToast.show(s);
        }

        function showSuccess(msg) {
            s = {
                rtl: true,
                class: "iziToast-" + "danger",
                title: "موفق!",
                message: msg,
                animateInside: !1,
                position: "topRight",
                progressBar: !1,
                icon: 'ri-check-fill',
                timeout: 3200,
                transitionIn: "fadeInLeft",
                transitionOut: "fadeOut",
                transitionInMobile: "fadeIn",
                transitionOutMobile: "fadeOut",
                color: "green",
                type: 'success'
                };
            iziToast.show(s);
        }

        function handleAjaxErr(XMLHttpRequest) {
    
            var errs = JSON.parse(XMLHttpRequest.responseText).errors;

            if(errs instanceof Object) {
                var errsText = '';

                Object.keys(errs).forEach(function(key) {
                    errsText += errs[key] + "<br />";
                });

                showErr(errsText);
            }
            else {
                var errsText = '';

                for(let i = 0; i < errs.length; i++)
                    errsText += errs[i].value;
                
                showErr(errsText);
            }
        }

    </script>

    @yield('customModal')
    @yield('customJS')

</body>
</html>

