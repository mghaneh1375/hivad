let timer;
let reminder;
let phone;
let isInUpdateMode = false;

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#loading").addClass("hidden");
            handleAjaxErr(XMLHttpRequest);
        },
    });

    $("#editBtn").on("click", function () {
        edit();
    });

    $("#doChangePassBtn").on("click", function () {
        activate2();
    });

    $("#sendCodeBtn").on("click", function () {
        sendCode();
    });

    $("#changePassBtn").on("click", function () {
        changePass();
    });

    $("#signUpBtn").on("click", function () {
        register();
    });

    $("#activateBtn").on("click", function () {
        activate();
    });

    $("#signInBtn").on("click", function () {
        signIn();
    });

    $("#profileBtn").on("mouseenter", function () {
        $("#profile-container").removeClass("hidden");
    });

    $("#profileSection").on("mouseleave", function () {
        $("#profile-container").addClass("hidden");
    });

    $("#password").keypress(function (e) {
        if (e.which == 13) {
            signIn();
            return false;
        }
    });

    function activateTimer() {
        timer = setInterval(() => {
            reminder--;
            if (reminder <= 0) {
                clearInterval(timer);
                $("#resendBtn").removeClass("hidden");
                $("#reminderText").addClass("hidden");
            }
            printReminder();
        }, 1000);
    }

    function activateTimer2() {
        timer = setInterval(() => {
            reminder--;
            if (reminder <= 0) {
                clearInterval(timer);
                $("#resendBtn2").removeClass("hidden");
                $("#reminderText2").addClass("hidden");
            }
            printReminder2();
        }, 1000);
    }

    function printReminder() {
        $("#reminder").text(reminder);
    }

    function printReminder2() {
        $("#reminder2").text(reminder);
    }

    function sendCode() {
        phone = $("#forgetPassUsername").val();

        if (phone.length === 0) {
            showErr("لطفا شماره همراه و رمزعبور خود را وارد نمایید");
            return;
        }

        $("#loading").removeClass("hidden");

        $.ajax({
            type: "post",
            url: FORGETPASS_ROUTE,
            data: {
                phone: phone,
            },
            success: function (res) {
                $("#loading").addClass("hidden");

                if (res.status === "ok") {
                    reminder = res.reminder;
                    printReminder2();
                    $("#forgetPassModal").addClass("hidden");
                    $("#changePassModal").removeClass("hidden");
                    activateTimer2();
                } else {
                    showErr(res.msg);
                }
            },
        });
    }

    function signIn() {
        let phone = $("#username").val();
        let password = $("#password").val();

        if (phone.length === 0 || password.length === 0) {
            showErr("لطفا شماره همراه و رمزعبور خود را وارد نمایید");
            return;
        }

        $("#loading").removeClass("hidden");

        $.ajax({
            type: "post",
            url: SIGNIN_ROUTE,
            data: {
                password: password,
                phone: phone,
            },
            success: function (res) {
                $("#loading").addClass("hidden");

                if (res.status === "ok") {
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    showErr(res.msg);
                }
            },
        });
    }

    function activate() {
        let code = $("#code").val();

        if (code.length === 0) {
            showErr("لطفا کد اعتبارسنجی را وارد نمایید");
            return;
        }

        $("#loading").removeClass("hidden");

        $.ajax({
            type: "post",
            url: ACTIVATE_ROUTE,
            data: {
                verification_code: code,
                username: phone,
            },
            success: function (res) {
                $("#loading").addClass("hidden");

                if (res.status === "ok") {
                    if (isInUpdateMode) {
                        showSuccess("حساب شما با موفقیت به روز شد");
                        $("#activateModal").addClass("hidden");
                    } else {
                        showSuccess("حساب شما با موفقیت ایجاد شد");
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    }
                } else {
                    showErr(res.msg);
                }
            },
        });
    }

    function activate2() {
        let code = $("#code2").val();
        let newPass = $("#newPass2").val();
        let confirmNewPass = $("#confirmNewPass2").val();

        if (
            code.length === 0 ||
            newPass.length === 0 ||
            confirmNewPass.length === 0
        ) {
            showErr("لطفا تمامی موارد را وارد نمایید");
            return;
        }

        if (newPass !== confirmNewPass) {
            showErr("رمزعبور جدید و تکرار آن یکسان نیستند");
            return;
        }

        $("#loading").removeClass("hidden");

        $.ajax({
            type: "post",
            url: ACTIVATE_ROUTE,
            data: {
                verification_code: code,
                username: phone,
                password: newPass,
                confirm_password: confirmNewPass,
            },
            success: function (res) {
                $("#loading").addClass("hidden");

                if (res.status === "ok") {
                    showSuccess("رمزعبور شما با موفقیت به روز شد");
                    $("#changePassModal").addClass("hidden");
                } else {
                    showErr(res.msg);
                }
            },
        });
    }

    function register() {
        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let password = $("#signuppassword").val();
        let rpassword = $("#signuprpassword").val();
        phone = $("#signupusername").val();

        if (
            firstname.length === 0 ||
            lastname.length === 0 ||
            password.length === 0 ||
            rpassword.length === 0 ||
            phone.length === 0
        ) {
            showErr("لطفا تمام اطلاعات لازم را پر نمایید");
            return;
        }

        if (password != rpassword) {
            showErr("رمزعبور و تکرار آن یکسان نیستند");
            return;
        }

        $("#loading").removeClass("hidden");

        $.ajax({
            type: "post",
            url: SIGNUP_ROUTE,
            data: {
                first_name: firstname,
                last_name: lastname,
                username: phone,
                password: password,
                rpassword: rpassword,
            },
            success: function (res) {
                $("#loading").addClass("hidden");

                if (res.status === "ok") {
                    reminder = res.reminder;
                    printReminder();
                    $("#signUpModel").addClass("hidden");
                    $("#activateModal").removeClass("hidden");
                    activateTimer();
                } else {
                    showErr(res.msg);
                }
            },
        });
    }

    function edit() {
        let fn = $("#editFirstname").val();
        let ln = $("#editLastname").val();
        let p = $("#editSignupusername").val();

        if (fn.length === 0 || ln.length === 0 || p.length === 0) {
            showErr("لطفا تمام اطلاعات لازم را پر نمایید");
            return;
        }

        $("#loading").removeClass("hidden");

        $.ajax({
            type: "post",
            url: EDIT_ROUTE,
            data: {
                first_name: fn,
                last_name: ln,
                phone: p,
            },
            success: function (res) {
                $("#loading").addClass("hidden");
                if (res.status === "ok") {
                    $("#editModal").addClass("hidden");

                    if (res.reminder !== undefined) {
                        $("#activateBtn").text(
                            "تکمیل فرآیند به روزرسانی اطلاعات کاربری"
                        );
                        isInUpdateMode = true;
                        phone = p;
                        reminder = res.reminder;
                        printReminder();
                        activateTimer();
                        $("#activateModal").removeClass("hidden");
                        return;
                    }

                    showSuccess("اطلاعات کاربری شما با موفقیت به روز شد");
                } else {
                    showErr(res.msg);
                }
            },
        });
    }

    function changePass() {
        let oldPass = $("#oldPass").val();
        let newPass = $("#newPass").val();
        let confirmNewPass = $("#confirmNewPass").val();

        if (
            oldPass.length === 0 ||
            newPass.length === 0 ||
            confirmNewPass.length === 0
        ) {
            showErr("لطفا تمام اطلاعات لازم را پر نمایید");
            return;
        }

        $("#loading").removeClass("hidden");

        $.ajax({
            type: "post",
            url: CHANGE_PASS_ROUTE,
            data: {
                oldPass: oldPass,
                newPass: newPass,
                confirmNewPass: confirmNewPass,
            },
            success: function (res) {
                $("#loading").addClass("hidden");

                if (res.status === "ok") {
                    showSuccess("رمزعبور شما با موفقیت تغییر یافت");
                    $("#editModal").addClass("hidden");
                } else {
                    showErr(res.msg);
                }
            },
        });
    }
});
