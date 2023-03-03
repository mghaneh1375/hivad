<style>

    button {
        background-color: transparent;
        padding: 5px;
        border-radius: 10px;
        border: 2px solid #d7d5c7;
        cursor: pointer;
    }

    .sign-in-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }
    
    .sign-in-container p {
        font-size: 16px;
    }

    .sign-in-container a {
        cursor: pointer;
        color: #b7985b;
    }

    .sign-in-container > div {
        display: flex;
        flex-direction: row;
        gap: 20px;
    }

    .sign-in-container input {
        padding: 5px;
    }

    .sign-in-container label {
        width: 100px;
        display: block;
        font-size: 16px;
    }

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

</style>

<div id="headerContainer" >
    <div id="headerContent">
        <nav>
            <ul id="mainNavigation">
                <li class='' data-menuID='-1'></li>
                <li class='' data-menuID='29671'>
                    <a data-menuID='29671' class='arrow '>امکانات هیواد</a>
                    <ul class=' subSecondNavigation' style='display: none;'>
                        
                        <li class='' data-menuID='29412'>
                            <a class=' ' href='/cafe'> کافی شاپ</a>
                        </li>
                        <li class='' data-menuID='29674'>
                            <a class=' ' href='/people'> متخصصین</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='/news'>اخبار</a>
                </li>
                <li>
                    <a href='/shop'>فروشگاه</a>
                </li>
                <li data-menuID='87665' data-isprofilemenu='False' data-temp='PageContent'>
                    <a onclick="document.location.href = '{{ route('articles.show') }}'">مقالات</a>
                </li>
                <li>
                    <a class='arrow '  data-menuID='29271' data-isprofilemenu='False' data-temp='PageContent'>گالری</a>
                    <ul class=' subSecondNavigation' style='display: none;'>
                    <li class='' data-menuID='29271'>
                        <a href='/galleries'>گالری تصاویر</a>
                    </li>
                    <li class='' data-menuID='29408'>
                        <a class=' ' href='/videos'>گالری فیلم</a>
                    </li>
                    </ul>
                </li>
                <li data-menuID='54423' data-isprofilemenu='False' data-temp='PageContent'>
                    <a class="selected" onclick="document.location.href = '{{ route('workTimes') }}'">ساعات کاری</a>
                </li>
                
                @if($show_survey)
                    <li data-menuID='98423' data-isprofilemenu='False' data-temp='PageContent'>
                        <a onclick="document.location.href = '{{ route('survey') }}'">نظر سنجی</a>
                    </li>
                @endif
                
                <li>
                    <a onclick="document.location.href = '{{ route('adviceRequest') }}'">درخواست مشاوره</a>
                </li>

                <li>
                    <a onclick="document.location.href = '{{ route('contactUs') }}'">تماس با ما</a>
                </li>
                <li data-menuID='29846'>
                    <a data-menuID='29846' class=' '>امکانات</a>
                </li>
            </ul>

        </nav>
    </div>

    <div>
        <div id="layout-header-top">
          @if(Auth::check())
          <p style="position: absolute;
    z-index: 1000;
    left: 0px;
    cursor: pointer;
    top: -44px;
    width: 199px;
    color: white;
    font-size: 16px;
    height: 59px;">پروفایل</p>
          @else

            <p onclick="$('#signInModal').removeClass('hidden');" style="position: absolute;
    z-index: 1000;
    left: 0px;
    cursor: pointer;
    top: -44px;
    width: 199px;
    color: white;
    font-size: 16px;
    height: 59px;">ورود / ثبت نام</p>

            @endif

            <a href="/">
                <div id="layout-logo" style=""></div>
            </a>
        </div>
    </div>
</div>


<div id="signInModal" class="modal hidden">
    <div class="modal-content">
        <h2>ورود / ثبت نام</h2>
        <div class="sign-in-container">
            <div>
                <label>نام کاربری</label>
                <input type="tel" id="username" placeholder="شماره همراه" />
            </div>
            <div>
                <label>رمزعبور</label>
                <input type="password" id="password" placeholder="******" />
            </div>
            <button>ورود</button>
            <p>
                <span>حساب کاربری ندارید؟</span>
                <a onclick="$('#signInModal').addClass('hidden'); $('#signUpModel').removeClass('hidden')">ثبت نام کنید</a>
            </p>
        </div>
        
        <div class="flex center gap10">
            <button  style="margin-left: 5px;" onclick="$('#signInModal').addClass('hidden')">بازگشت</button>
        </div>
    </div>
</div>


<div id="signUpModel" class="modal hidden">
    <div class="modal-content">
        <h2>ثبت نام</h2>
        <div class="sign-in-container">

            <div>
                <label>نام</label>
                <input type="text" id="firstname" placeholder="نام" />
            </div>
            
            <div>
                <label>نام خانوادگی</label>
                <input type="text" id="lastname" placeholder="نام خانوادگی" />
            </div>

            <div>
                <label>شماره همراه</label>
                <input type="tel" id="signupusername" placeholder="شماره همراه" />
            </div>

            <div>
                <label>رمزعبور</label>
                <input type="password" id="signuppassword" placeholder="******" />
            </div>

            <div>
                <label>تکرار رمزعبور</label>
                <input type="password" id="signuprpassword" placeholder="******" />
            </div>

            <button onclick="register()">ثبت نام</button>
            
        </div>
        
        <div class="flex center gap10">
            <button  style="margin-left: 5px;" onclick="$('#signUpModel').addClass('hidden'); $('#signInModal').removeClass('hidden');">بازگشت</button>
        </div>
    </div>
</div>

<script>

    function register() {

        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let password = $("#signuppassword").val();
        let rpassword = $("#signuprpassword").val();
        let username = $("#signupusername").val();


        if(
            firstname.length === 0 || lastname.length === 0 || password.length === 0 ||
                rpassword.length === 0 || username.length === 0
        ) {
            showErr("لطفا تمام اطلاعات لازم را پر نمایید");
            return;
        }

        if(password != rpassword) {
            showErr("رمزعبور و تکرار آن یکسان نیستند");
            return;
        }



        $.ajax({
            type: 'post',
            url: '{{ route('signUp') }}',
            data: {
                first_name: firstname,
                last_name: lastname,
                username: username,
                password: password,
                rpassword: rpassword
            },
            headers: {
                'Accept': 'application/json'
            },
            success: function(res) {

                if(res.status === 'ok') {
                    showSuccess();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
                else {
                    showErr(res.msg);
                }

            }
        });

    }

    function showSuccess() {
        alert('عملیات موردنظر با موفقیت انجام شد.');
    }

    function showErr(msg) {
        alert(msg);
    }

</script>