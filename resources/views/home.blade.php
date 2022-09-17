<!DOCTYPE html>

<html>

<head>

    <title>باشگاه آجودانیه</title>

    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Designer" content="Design By haftsetare.com" />
    <meta name="description" />
    <meta name="keywords" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favIcon.jpg') }}">
    <meta name="viewport" content="initial-scale=1 ,width=device-width, user-scalable=yes">

    <meta property="og:locale" content="fa_IR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="باشگاه آجودانیه" />
    <meta property="og:site_name" content="باشگاه آجودانیه" />
    <meta property="og:image" content="{{ asset('assets/images/favIcon.jpg') }}" />

    <meta name="robots" content="index, follow">

    <meta name="language" content="fa">


    <link id="p7csslink" data-data1="da0fa0f9-c854-40e2-9fc2-02608b8859e5" data-data2="637469158829958600" count="0" data-wid="0" />
    <link href="{{ asset('assets/css/siteLayout95.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/css_underDesign.css') }}" rel="stylesheet" />
    
    <meta name="enamad" content="360329"/>
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
            height: 300px;
            width: 300px;
            padding: 0 !important;
        }

        .wrapper_Col > #newsWidget > div img {
            max-height: 130px !important;
            width: 100%;
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

<script>

        var dynamicFields = {
            platform7Permission: { AmazingOffer: 'False', PageProduct1 : 'True'} ,
            userExmape:'',
            OnlineFoodShopping: 'False',
            Root: '',
            UserMembershipFee: '0',
            FormData: { logID: '', formID: '', boxID: '', currentUser: '', o: ''},
            LoadFunction: 'MasterPageLoad',
            AddminPermission: 'False',
            bascketData: '', PhoneNumberRegistration: 'False', IsPlatform7 : 'False',
            prefix: '',
            menuID: '-1', menuName: 'خانه',
            userID: '', haspageContent: '', adminHaspageContent: '', hasFooterContent: '', 
            SeoLinkList: '[]', BaseMenuID: '-1', 
            IsProfileMenu: 'False', DigitalShopping: 'False' , footerjsonContentList:[],
        }; 

</script>

</head>

<body data-menuid="-1" data-expire="False" data-wid="762" data-un="" data-roles="" data-uid="" data-ap="False" data-isprofilemenu="false" class="    noLogin     " style=" " priceUnit="">

    <div id="msScroll_wrapper">

        @include('layouts.navbar')

        <div id="container_wrapper">
            <div id="container">


                <main id="mainContent">
                    <div class="mainContent-wrapper">
                    </div>
                    <div class="textContent first"></div>
                    <div id="siteMap"><span>خانه</span></div>
                    <div id="wrapper-main-page" class="textContent" data-menuid="">



                    </div>

                </main>


            </div>
        </div>


        <div id="pageCover"></div>

        @include('layouts.footer')
    </div>

    
    @include('layouts.progress')
    @include('layouts.comment')

<script src="{{ asset('assets/js/siteLayout.min.js') }}" defer></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}" defer></script>
<script src="{{ asset('assets/js/js_underDesign.js') }}" defer></script>
<script src="{{ asset('assets/js/commonJS.js') }}"></script>

</body>
</html>

