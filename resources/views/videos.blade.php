
<!DOCTYPE html>

<html>

<head>

    <title>گالری فیلم</title>

    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Designer" content="Design By haftsetare.com" />
    <meta name="description" content="گالری فیلم" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="/Content/base/dynamic/shopping762/favIcon.jpg?ver=1">
        <meta name="viewport" content="initial-scale=1 ,width=device-width, user-scalable=yes">

    <meta property="og:locale" content="fa_IR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="گالری فیلم" />
    <meta property="og:site_name" content="گالری فیلم" />
    <meta property="og:image" content="/Content/base/dynamic/shopping762/favIcon.jpg?ver=1" />


    <meta name="robots" content="index, follow">
    <meta name="language" content="fa">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="{{ asset('assets/css/siteLayout95.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/css_underDesign.css') }}" rel="stylesheet" />


    <style>
        .hidden {
            display: none !important;
        }
        .modal {
            display: block;
            position: fixed;
            z-index: 100000;
            padding-top: 50px;
            padding-bottom: 50px;
            left: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            padding: 15px !important;
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 70%;
            direction: rtl;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s;
        }
        .gap10 {
            gap: 10px;
        }
        .center {
            align-self: center;
            justify-content: center;
            align-items: center;
        }
        .flex {
            display: flex;
        }
    </style>

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
            prefix: 'videos-',
            bascketData: '', PhoneNumberRegistration: 'False', IsPlatform7 : 'False',
            WebsiteID:762, menuID: '29271', menuName: 'گالری-تصاویر',
            userID: '', haspageContent: '', adminHaspageContent: '', hasFooterContent: '', 
            SeoLinkList: '[]', BaseMenuID: '29271', IsProfileMenu: 'False', 
            DigitalShopping: 'False', 
        }

    </script>

</head>

<body data-menuid="29271" data-wid="762" data-ap="False" data-isprofilemenu="false" class="    noLogin     " >

    <div id="msScroll_wrapper">

        @include('layouts.virtualView')
        @include('layouts.navbar')

        <div id="container_wrapper">
            <div id="container">


                <main id="mainContent">
                    <div class="mainContent-wrapper">
                    </div>
                    <div class="textContent first"></div>
                    <div id="siteMap"><span>گالری فیلم</span></div>
                    <div id="wrapper-main-page" class="textContent" data-menuid="">
                    </div>

                </main>
            </div>
        </div>

        <div id="pageCover"></div>
        @include('layouts.footer')

    </div>

    @include('layouts.progress')


   
    <div id="playModal" class="modal hidden">
        <div class="modal-content">
            <video id="myCurrentVideo" width="100%" controls>
                
                Your browser does not support the video tag.
              </video> 
            <div class="flex center gap10">
                <input type="button" value="بازگشت" class="btn green"  style="margin-left: 5px;" onclick="$('#playModal').addClass('hidden')">
            </div>
        </div>
    </div>

<script src="{{ asset('assets/js/siteLayout.min.js') }}" defer></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}" defer></script>
<script src="{{ asset('assets/js/js_underDesign.js') }}" defer></script>
<script src="{{ asset('assets/js/commonJS.js') }}"></script>

<script>
    $(document).ready(function() {
        $(document).on("click", ".videoImg", function(){
            var src = $(this).attr('src');
            var base = '{{ asset('storage/videos') }}';
            var videoFile = base + src.split(".")[0].split("/crop")[1] + ".mp4";
            $("#myCurrentVideo").attr('src', videoFile);
            $("#playModal").removeClass('hidden');
        });

    })
</script>

</body>
</html>

