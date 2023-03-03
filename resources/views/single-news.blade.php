<!DOCTYPE html>

<html>

<head>

    <title>{{$news->title}}</title>

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

</head>

<body data-menuid="-2" data-expire="False" data-wid="762" data-un="" data-roles="" data-uid="" data-ap="False" data-isprofilemenu="" class="    noLogin    haspageContent   " style=" " priceUnit="">

    <div id="msScroll_wrapper">

        <div id="virtualView" >

                <div><div><a class="header-opener"><span><span></span></span></a>

<div class="top_header1"><div class="nav_1"><div class="right_nav1"><div class="social_net"><ul><li class="each_net"><a href="#" title="" style="background-image: url(/Content/base/dynamic/shopping572/img/91327.jpg);"></a></li><li class="each_net"><a href="#" title="" style="background-image: url(/Content/base/dynamic/shopping572/img/91330.jpg);"></a></li><li class="each_net"><a href="https://www.instagram.com/ajoudanieh/" style="background-image:url(/Content/base/dynamic/shopping572/img/91329.jpg);" target="_blank"></a></li></ul></div></div></div></div></div></div>
        </div>
        
        @include('layouts.navbar')

        <div id="container_wrapper">
            <div id="container">


                <main id="mainContent">

                    <div class="mainContent-wrapper"></div>

                    <div class="textContent first"></div>
                    <div id="siteMap"><span></span></div>

                    <div id="wrapper-main-page" class="textContent" data-menuid="">


                        <div id="dialogContent">

                            <div class="news-header" id="newsWidget">
                                <div>
                                    <span id="newsInfo">
                                        <span class="newsDate">{{$d}}</span>

                                        <a data-newsid="9399"><h3>{{$news->title}}</h3></a>
                                        <p>{{$news->digest}}</p>
                                    </span>
                                        
                                    <div class="info_wrapper_wrapper ">
                                        <div class="info_wrapper" style="display:none;">
                                            
                                            <span class="logsynce_eye"><span class="logsynce" data-actid="60" data-tid="39" data-id="9399"></span><i class="fa fa-eye"></i></span>

                                        </div>
                                    </div>

                                    <a class="img_link_wrapper" data-temp='NewsText' data-newsid="9399">
                                        <span style="display:block;">
                                                <img src="{{ asset('Content/images/news/crop/' . $news->image) }}"
                                                    alt="{{$news->alt}}" />
                                        </span>
                                    </a>

                                </div>

                            </div>
                            
                            <div class="news-content">                 
                                    {!! $news->description !!}
                            </div>

                            <div class="tagList">
                                {{$news->tags}}
                            </div>
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

