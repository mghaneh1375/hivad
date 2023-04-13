function justNumber(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === "paste") {
        key = event.clipboardData.getData("text/plain");
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function showErr(msg) {
    s = {
        rtl: true,
        class: "iziToast-" + "danger",
        title: "ناموفق",
        message: msg,
        animateInside: !1,
        position: "topRight",
        progressBar: !1,
        icon: "ri-close-fill",
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
        icon: "ri-check-fill",
        timeout: 3200,
        transitionIn: "fadeInLeft",
        transitionOut: "fadeOut",
        transitionInMobile: "fadeIn",
        transitionOutMobile: "fadeOut",
        color: "green",
        type: "success",
    };
    iziToast.show(s);
}

function handleAjaxErr(XMLHttpRequest) {
    var errs = JSON.parse(XMLHttpRequest.responseText).errors;

    if (errs instanceof Object) {
        var errsText = "";

        Object.keys(errs).forEach(function (key) {
            errsText += errs[key] + "<br />";
        });

        showErr(errsText);
    } else {
        var errsText = "";

        for (let i = 0; i < errs.length; i++) errsText += errs[i].value;

        showErr(errsText);
    }
}
