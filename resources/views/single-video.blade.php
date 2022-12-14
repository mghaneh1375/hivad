
<!DOCTYPE html>

<html>

<head>

    <title>{{$video->title}}</title>

    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Designer" content="Design By haftsetare.com" />
    <meta name="description" content="باشگاه آجودانیه ضمن ابراز تسلیت و اعلام همدردی با خانواده این درگذشتگان از خداوند متعال برای این عزیران از دست رفته طلب مغفرت کرده و برای خانواده های بزرگوار ایشان صبر جمیل از خداوند متعال خواهان است " />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="/Content/base/dynamic/shopping762/favIcon.jpg?ver=1">
        <meta name="viewport" content="initial-scale=1 ,width=device-width, user-scalable=yes">

    <meta property="og:locale" content="fa_IR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="جان باختن 66 هموطن در سانحه سقوط هواپیمای مسافربری تهران-یاسوج" />
    <meta property="og:site_name" content="جان باختن 66 هموطن در سانحه سقوط هواپیمای مسافربری تهران-یاسوج" />
    <meta property="og:image" content="/Content/images/762/news/crop/ec4f2cb0-0d7b-4330-9ade-3bbffffcd9cf.jpg" />



    <link href="{{ asset('assets/css/siteLayout95.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/css_underDesign.css') }}" rel="stylesheet" />

        <meta name="robots" content="index, follow">

    <meta name="language" content="fa">
<script>


        var dynamicFields = {
            platform7Permission: { AmazingOffer: 'False', PageProduct1 : 'True'}  ,
                userExmape:'',
            OnlineFoodShopping: 'False',
            Root: '',
            UserMembershipFee: '0',
            FormData: { logID: '', formID: '', boxID: '', currentUser: '', o: ''},
            LoadFunction: 'MasterPageLoad',
            AddminPermission: 'False',

            bascketData: '', PhoneNumberRegistration: 'False', IsPlatform7 : 'False',
                prefix: 'single-news-', WebsiteID:762, menuID: '-2', menuName: '',
                userID: '', haspageContent: 'True', adminHaspageContent: '', hasFooterContent: '', 
                SeoLinkList: '[]', BaseMenuID: '', IsProfileMenu: '', DigitalShopping: 'False', jsonContentList:[] , footerjsonContentList:[]
        }; 

</script>

</head>

<body data-menuid="-2" data-expire="False" data-wid="762" data-un="" data-roles="" data-uid="" data-ap="False" data-isprofilemenu="" class="    noLogin    haspageContent   " style=" " priceUnit="">

    <div id="msScroll_wrapper">

        @include('layouts.virtualView')
        @include('layouts.navbar')

        <div id="container_wrapper">
            <div id="container">

                <main id="mainContent">
                    <div class="mainContent-wrapper">
                    </div>
                    <div class="textContent first"></div>
                    <div id="siteMap"><span></span></div>
                    <div id="wrapper-main-page" class="textContent" data-menuid="">

<style>
    #loading-img {
        display: none;
    }
    div#dialogContent {
        width: unset !important;
        max-width: unset !important;
        padding: 20px;
        overflow-x: hidden;
    }
    
    .span_loaddingImg {
        display: none !important;
    }

    #dialogContent {
        height: auto;
        direction: rtl;
        background: white;
    }

    .likeProduct {
        float: right;
        top: 64px;
    }
</style>

<div id="dialogContent">

    <div class="news-header" id="newsWidget">
        <div>
            <span id="newsInfo">
                <a data-newsid="9399"><h3>{{$video->title}}</h3></a>
                <video width='100%' controls='' src='{{ $video->file }}'>
                        Your browser does not support the video tag.
                </video>
            </span>
        </div>

    </div>
    
    @if($video->description != null && $video->description != "")
        <div class="news-content">
            <p>{!! $video->description !!}</p>
        </div>
    @endif

    @if($video->tags != null)
        <div class="tagList">
            {{$video->tags}}
        </div>
    @endif
</div>

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

