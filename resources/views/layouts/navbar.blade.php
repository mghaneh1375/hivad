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
        width: 125px;
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

    .profile {
        position: absolute;
        z-index: 1000;
        left: 0px;
        cursor: pointer;
        top: -44px;
        width: 199px;
        color: white;
        font-size: 16px;
        height: 59px;
    }

    #signInSignUpBtn {
        position: absolute;
        z-index: 1000;
        left: 0px;
        cursor: pointer;
        top: -44px;
        width: 199px;
        color: white;
        font-size: 16px;
        height: 59px;
    }

    .profile-container {
        background-color: white;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        width: 200px;
        margin-right: -75px;
        margin-top: -10px;
        display: flex;
        flex-direction: column;
        padding: 5px 5px 10px 5px;
    }

    .profile-container > a {
        font-size: 14px;
        color: #707070;
        width: 100%;
        padding: 6px 3px 6px 3px;
        border-bottom: 1px solid #c0c0c0;
        text-decoration: none;
        line-height: 24px;
        text-align: center;
    }

    .profile-container > a:last-child {
        border: none;
    }

    .seperator {
        height: 1px;
        width: calc(100% - 50px);
        margin: 30px auto 30px auto;
        border-bottom: 1px dotted #777;
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
            <div  id="profileSection" class="profile">
                <p id="profileBtn">پروفایل</p>
                <div id="profile-container" class="profile-container hidden">
                    <a target="_self" href="{{ route('products.my') }}">محصولات من</a>
                    <a onclick="$('#editModal').removeClass('hidden')">ویرایش اطلاعات کاربری</a>
                    @if(Auth::user()->level == App\Models\User::ADMIN_USER_ROLE)
                        <a href="{{ route('panel') }}">پنل ادمین</a>
                    @endif
                    <a target="_self" href="{{ route('logout') }}">خروج</a>
                </div>
            </div>
          @else

            <p id="signInSignUpBtn" onclick="$('#signInModal').removeClass('hidden');">ورود / ثبت نام</p>

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
                <label>شماره همراه</label>
                <input type="tel" id="username" placeholder="09xxxxxxxxx" />
            </div>
            <div>
                <label>رمزعبور</label>
                <input type="password" id="password" placeholder="******" />
            </div>
            <button id="signInBtn">ورود</button>
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

            <button id="signUpBtn">ثبت نام</button>
            
        </div>
        
        <div class="flex center gap10">
            <button  style="margin-left: 5px;" onclick="$('#signUpModel').addClass('hidden'); $('#signInModal').removeClass('hidden');">بازگشت</button>
        </div>
    </div>
</div>


@if(Auth::check())

    <?php $user = Auth::user(); ?>

    <div id="editModal" class="modal hidden">

        <div class="modal-content">
            <h2>ویرایش اطلاعات کاربری</h2>
            <div class="sign-in-container">

                <div>
                    <label>نام</label>
                    <input type="text" value="{{ $user->first_name }}" id="editFirstname" placeholder="نام" />
                </div>
                
                <div>
                    <label>نام خانوادگی</label>
                    <input type="text" value="{{ $user->last_name }}" id="editLastname" placeholder="نام خانوادگی" />
                </div>

                <div>
                    <label>شماره همراه</label>
                    <input type="tel" value="{{ $user->phone }}" id="editSignupusername" placeholder="شماره همراه" />
                </div>

                <button id="editBtn">ویرایش اطلاعات</button>

            </div>

            <div class="seperator"></div>
            <h2>تغییر رمزعبور</h2>

            <div class="sign-in-container">

                <div>
                    <label>رمزعبور فعلی</label>
                    <input type="password" id="oldPass" placeholder="******" />
                </div>
                
                <div>
                    <label>رمزعبور جدید</label>
                    <input type="password" id="newPass" placeholder="******" />
                </div>
                
                <div>
                    <label>تکرار رمزعبور جدید</label>
                    <input type="password" id="confirmNewPass" placeholder="******" />
                </div>

                <button id="changePassBtn">تغییر رمزعبور</button>

            </div>

            
            <div class="flex center gap10">
                <button  style="margin-left: 5px;" onclick="$('#editModal').addClass('hidden');">انصراف</button>
            </div>
        </div>
    </div>

@endif


<div id="activateModal" class="modal hidden">
    <div class="modal-content">
        <h2>اعتبارسنجی</h2>
        <div class="sign-in-container">

            <p>لطفا کد ارسال شده به شماره همراه وارد شده را وارد نمایید</p>
            <div>
                <label>کد اعتبارسنجی</label>
                <input type="text" id="code" onkeypress='justNumber(event)' maxlength="6" placeholder="XXXXX" />
            </div>

            <button id="activateBtn">تکمیل فرآیند ثبت نام</button>

            <p id="reminderText">ارسال مجدد کد اعتبارسنجی تا <span>&nbsp;</span><span id="reminder"></span> ثانیه دیگر</p>
            <button id="resendBtn" class="hidden">ارسال مجدد کد اعتبارسنجی</button>
            
        </div>
        
        <div class="flex center gap10">
            <button  style="margin-left: 5px;" onclick="$('#activateModal').addClass('hidden'); if(isInUpdateMode) $('#editModal').removeClass('hidden'); else  $('#signUpModel').removeClass('hidden'); ">بازگشت</button>
        </div>
    </div>
</div>


<script src='{{ asset('assets/js/signup.js?v=1.2') }}' defer></script>