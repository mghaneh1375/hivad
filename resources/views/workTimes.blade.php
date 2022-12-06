
<!DOCTYPE html>

<html>

<head>

    <title>ساعات کاری</title>

    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Designer" content="Design By haftsetare.com" />
    <meta name="description" content="نظرسنجی" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="/Content/base/dynamic/shopping762/favIcon.jpg?ver=1">
        <meta name="viewport" content="initial-scale=1 ,width=device-width, user-scalable=yes">

    <meta property="og:locale" content="fa_IR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="نظرسنجی" />
    <meta property="og:site_name" content="نظرسنجی" />
    <meta property="og:image" content="/Content/base/dynamic/shopping762/favIcon.jpg?ver=1" />


    <meta name="robots" content="index, follow">
    <meta name="language" content="fa">

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
            prefix: 'workTime-',
            bascketData: '', PhoneNumberRegistration: 'False', IsPlatform7 : 'False',
            WebsiteID:762, menuID: '29453', menuName: 'تماس-با-ما',
            userID: '', haspageContent: '', adminHaspageContent: '', hasFooterContent: '', 
            SeoLinkList: '[]', BaseMenuID: '29453', IsProfileMenu: 'False', 
            DigitalShopping: 'False', 
        }

    </script>

</head>

<body data-menuid="29453" data-expire="False" data-wid="762" data-ap="False" data-isprofilemenu="false" class="noLogin">

    <div id="msScroll_wrapper">

        @include('layouts.navbar')

        <div id="container_wrapper">
            <div id="container">


                <main id="mainContent">
                    <div class="mainContent-wrapper">
                        <div style="display: flex; flex-direction: column; margin: 30px; gap: 20px">
                            @foreach ($days as $day)

                                <div style="display: flex; flex-direction: row; gap: 50px;">
                                    <div style="align-self: center">
                                        <h1 style="font-size: 20px">{{ $day['day'] }}</h1>
                                        <p style="font-size: 16px">از ساعت {{ $day['start'] }} تا {{ $day['end'] }}</p>
                                    </div>
                                    @foreach ($day['peoples'] as $people)
                                        <center style="font-size: 14px">
                                            <img width="100px" src="{{ $people['img'] }}" />
                                            <p>{{ $people['name'] }}</p>
                                            <p>{{ $people['tag'] }}</p>
                                            @foreach ($people['times'] as $time)
                                                <p>از ساعت {{ $time[0] }} تا {{ $time[1] }}</p>
                                            @endforeach
                                            
                                            @if($can_booking)
                                                <button onclick="request({{ json_encode($people['times']) }}, {{ json_encode($people['ids']) }})">درخواست مشاوره</button>
                                            @endif
                                        </center>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
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

   
    <div id="registryModal" class="modal hidden">
        <div class="modal-content">
            
            <div>
                <input id="name" placeholder="نام و نام خانوادگی" type="text" />
            </div>
            
            <div style="margin-top: 10px">
                <input id="phone" placeholder="شماره همراه" type="tel" />
            </div>

            <div style="margin-top: 10px">
                <label style="font-size: 14px;" for="date">تاریخ موردنظر</label>
                <select style="height: 40px" id="date">
                    <option value="curr">این هفته</option>
                    <option value="next">هفته بعد</option>
                    <option value="next2">دو هفته بعد</option>
                    <option value="next3">سه هفته بعد</option>
                    <option value="next4">چهار هفته بعد</option>
                </select>
            </div>
            
            <div id="times"></div>

            <div>
                <input type="button" value="ثبت وقت" class="btn green"  style="margin-left: 5px;" onclick="submit()">
                <input type="button" value="بازگشت" class="btn green"  style="margin-left: 5px;" onclick="$('#registryModal').addClass('hidden')">
            </div>
        </div>
    </div>

    <script>

        function request(times, ids) {
            
            if(times.length > 1) {
                
                var html = "<div><label style='font-size: 14px' for='wanted_time'>زمان موردنظر</label><select style='height: 40px' id='wanted_time'>";
                var i = 0;

                times.forEach(elem => {
                    html += "<option value='" + ids[i++] + "'>" + elem[0] + " تا " + elem[1] + "</option>";
                });

                html += '</select></div>';

                $("#times").empty().append(html).removeClass('hidden');
            }
            else {
                $("#times").empty().addClass('hidden');
            }

            $("#registryModal").removeClass('hidden');
        }

        function submit() {

            let name = $("#name").val();
            let phone = $("#phone").val();

            if(name.length === 0 || phone.length === 0) {
                alert("لطفا تمامی اطلاعات لازم را پرنمایید.");
                return;
            }

            let date = $("#date").val();
            let wantedTime = $("#wanted_time").val();

            $.ajax({
                type: 'post',
                url: '{{ route('api.submitTimeRequest') }}',
                data: {
                    name: name,
                    phone: phone,
                    date: date,
                    people_work_time_id: wantedTime
                },
                success: function(res) {
                    if(res.status === "ok") {
                        alert("زمان موردنظر شما با موفقیت در سیستم ثبت گردید و با شما تماس گرفته خواهد شد.");
                        $('#registryModal').addClass('hidden');
                    }
                }
            });

        }

    </script>

</body>
</html>

