// device detection
$("#headerContainer").append(
    '<div  id="menuPageCover"  onClick="closeLeftMenu()"></div>'
);
$('a[data-menuid="29269"]').click(function () {
    document.location.href = "http://ketring.haftsetare.com";
});
function checkIsMobile() {
    var isMobile = false;
    if (
        /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
            navigator.userAgent
        ) ||
        /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
            navigator.userAgent.substr(0, 4)
        )
    )
        isMobile = true;

    return isMobile;
}
$(window).load(function () {
    $("ul#mainNavigation  >li > a").append('<span class="bullet"></span>');
    if (checkIsMobile()) touchScroll();
});
function closeLeftMenu() {
    $("body").removeClass("head-active");
}
function touchScroll() {
    var starty;
    document.addEventListener(
        "touchstart",
        function (e) {
            var touchobj = e.changedTouches[0];
            starty = parseInt(touchobj.clientY);
        },
        false
    );

    document.addEventListener(
        "touchend",
        function (e) {
            if (
                $("body").attr("data-menuid") == -1 &&
                !$("body").hasClass("head-active")
            ) {
                var touchobj = e.changedTouches[0];
                var endY = parseInt(touchobj.clientY);
                if (starty - endY > 100 || starty - endY < -100) {
                    if (starty > endY)
                        SetResizableAnimatation(
                            $("div#page_wrap > span.active").index() + 1
                        );
                    else
                        SetResizableAnimatation(
                            $("div#page_wrap > span.active").index() - 1
                        );
                }
            }
        },
        false
    );
}

if (window.addEventListener)
    window.addEventListener("DOMMouseScroll", wheel, false);
window.onmousewheel = document.onmousewheel = wheel;

function wheel(event) {
    var elem = $(event.target).closest("#searchResualtPage");
    if (elem.length == 0 && $("body").attr("data-menuid") == -1) {
        if (!checkIsMobile()) {
            var delta = 0;
            if (event.wheelDelta) delta = event.wheelDelta / 120;
            else if (event.detail) delta = -event.detail / 3;

            var index = $("div#page_wrap > span.active").index();

            if (delta > 0) {
                index--;
            } else {
                index++;
            }

            SetResizableAnimatation(index);
        }
        // if (event.preventDefault) event.preventDefault();
        // event.returnValue = false;
    }
}

var mouseWheeling = false;
function SetResizableAnimatation(index) {
    if (mouseWheeling) return false;

    mouseWheeling = true;
    var page_wraplength = $("div#page_wrap > span").length;
    if (index >= page_wraplength || index < 0) {
        mouseWheeling = false;
        return;
    }

    $("div#page_wrap > span.active").removeClass("active");
    $("div#page_wrap > span:eq(" + index + ")").addClass("active");

    var $resizable = $(
        '.resizable[data-boxid="' +
            $("div#page_wrap > span.active").attr("data-boxid") +
            '"]'
    );

    $(".resizable").removeClass("animated");
    setTimeout(function () {
        $resizable.addClass("animated");
        mouseWheeling = false;
        if ($resizable.attr("data-boxstyle") == "services")
            $("body").addClass("grayToggle");
        else $("body").removeClass("grayToggle");
    }, 1000);

    var t3d = "translate3d(0px, -" + $(window).height() * index + "px, 0px)";
    if (index == 0) {
        $("#msScroll_wrapper").attr("style", "opacity:1;");
    } else {
        $("#msScroll_wrapper")
            .css("transform", t3d)
            .css("-ms-transform", t3d)
            .css("-webkit-transform", t3d);
    }
}

$(
    'ul#mainNavigation li a[data-menuid="29671"], ul#mainNavigation li a[data-menuid="29846"]'
).live("click", function () {
    if (!checkIsMobile()) menuScrolling(38865, 1, $(this));
});

function menuScrolling(boxID, step, $this) {
    $("#mainNavigation a").removeClass("selected");
    $("#mainNavigation li").removeClass("selected");
    if ($this != null) {
        $this.addClass("selected");
        $this.find(">a").addClass("selected");
    }

    var timeDelay = 0;
    if ($("body").attr("data-menuid") != -1) {
        ChengePage("/", "PageContent", false, -1);
        $("#loading-img").show();
    }

    var menuAnimateTm = setInterval(function () {
        var $box = $(
            "#wrapper-main-page .resizable[data-boxid='" + boxID + "']"
        ).position();
        if ($box != null) {
            clearTimeout(menuAnimateTm);
            SetResizableAnimatation(step);
            setTimeout(function () {
                SetResizableAnimatation(step);
            }, 1000);
            $("#loading-img").hide();
        }
        timeDelay = 300;
    }, timeDelay);
    window.history.pushState("", "", "/");
}

$(window).resize(function () {
    setServiceBoxHieght();
    $(".border_style span:nth-child(1)").css(
        "height",
        $(".border_style").height() - 211
    );
});

var pageFirstLoad = true;
function AfterMadulesLoad() {
    setServiceBoxHieght();

    $(
        '#wrapper-main-page .resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="slideshow"]'
    ).each(function () {
        if ($(this).find(".btn-expand").length == 0) {
            $(this).append(
                '<a data-text="بزرگ نمایی" class="btn btn-expand" ><span>بزرگ نمایی</span><i></i></a> <a data-text="کوچک نمایی" class="btn btn-reduce " ><span>کوچک نمایی</span><i></i></a>'
            );
        }
        $(this)
            .find("img")
            .each(function () {
                $(this).after(
                    '<span style="background-image: url(' +
                        $(this).attr("src") +
                        ')"></span>'
                );
            });

        $(
            '#wrapper-main-page .resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="gallery"]'
        ).appendTo(
            '.resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="content"] > div'
        );
        //$('#wrapper-main-page .resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="gallery"]').remove()
    });

    if (
        $(
            '#wrapper-main-page .resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="content"] .border_style'
        ).length == 0
    ) {
        $(
            '.resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="content"] > div'
        ).append(
            '<div class="border_style"><span></span><span></span><span></span></div>'
        );
    }

    $(".border_style span:nth-child(1)").css(
        "height",
        $(".border_style").height() - 211
    );

    $("a.btn.btn-expand").live("click", function () {
        $(this).parent().addClass("largeSize");
        $("a.btn.btn-expand").hide();
        setTimeout(function () {
            $("a.btn.btn-reduce").show();
        }, 1300);
    });
    $("a.btn.btn-reduce").live("click", function () {
        $(this).parent().removeClass("largeSize");

        $("a.btn.btn-reduce").hide();
        setTimeout(function () {
            $("a.btn.btn-expand").show();
        }, 1300);
    });

    $('.resizable[data-boxstyle="Employees"] .blurbs .catblurb:first').addClass(
        "active"
    );
    $('.resizable[data-boxstyle="timeLine"] .blurbs .catblurb:first').addClass(
        "active"
    );

    $('.resizable[data-boxstyle="paralax"] img').each(function () {
        if ($(this).attr("src") != null && $(this).attr("src") != "") {
            $(this).replaceWith(
                '<span style="background-image: url(' +
                    $(this).attr("src") +
                    ');"></span >'
            );
        }
    });

    $('#wrapper-main-page .resizable[data-boxstyle="slideGallery"]').each(
        function () {
            var $this = $(this);
            if ($this.find("#galleryContent .prevSlideNews").length == 0) {
                $this
                    .find("#galleryContent")
                    .append(
                        '<span class="prevSlideNews" onClick="prevSlideNews(this)"></span><span class="nextSlideNews" onClick="nextSlideNews(this)"></span>'
                    );

                $this
                    .find("#galleryContent ul li:first")
                    .css("width", 0)
                    .css("margin-left", 0);
            }
        }
    );

    $(".wrapper_Col div#newsWidget > div").each(function () {
        $(this).find(".img_link_wrapper").prependTo($(this));
        $(this)
            .find(".newsDate")
            .prependTo($(this).find(".info_wrapper_wrapper "));
        $(this)
            .find(".info_wrapper_wrapper ")
            .insertAfter($(this).find("span#newsInfo > a:first"));
        $(this)
            .find(".ah7socialMedia")
            .insertAfter($(this).find(".moreNewsContent"));
    });

    var $img = $("div#newsWidget img"),
        totalImg = $img.length;
    function waitImgDone() {
        totalImg--;

        if (!totalImg) {
            // $("div#newsWidget").isotope({ isOriginLeft: false });
        }
    }

    $img.each(function () {
        if (this.complete) {
            waitImgDone();
        } else {
        }
        $(this)
            .load(function () {
                waitImgDone();
            })
            .error(function () {
                waitImgDone();
            });
    });

    // $('.resizable[data-tmplname="slideshow"]').each(function () {
    //     if ($(this).find("#scroll_diamond").length == 0)
    //         $(this).append(scroll_diamond("down", 1, "گالری"));
    // });
    // $('.resizable[data-boxstyle="services"]').each(function () {
    //     if ($(this).find("#scroll_diamond").length == 0) {
    //         $(this).append(scroll_diamond("up", 0, "صفحه اصلی"));
    //         $(this).append(scroll_diamond("down", 2, "نامشخص پایین"));
    //     }
    // });
    // $('.resizable[data-boxstyle="aboutAjodanie"]').each(function () {
    //     if ($(this).find("#scroll_diamond").length == 0) {
    //         $(this).append(scroll_diamond("up", 1, "قسمت بالا 2"));
    //         $(this).append(scroll_diamond("down", 3, "اطلاعات تماس"));
    //     }
    // });

    $(
        '#wrapper-main-page .resizable[data-tmplname="slideshow"] .slides-front > div > a'
    ).each(function () {
        if ($(this).find("btn").length == 0) {
            $(this).find(" > *").appendTo($(this).parent());
            $(this)
                .addClass("btn")
                .html("Ù…Ø´Ø§Ù‡Ø¯Ù‡ Ø¨ÛŒØ´ØªØ±")
                .appendTo($(this).parent().find(".slideShowContent"));
        }
    });

    $('.resizable[data-boxstyle="aboutAjodanie"]').each(function () {
        if (!$(this).find("#ajodanie").length)
            $(this)
                .find("> div:first")
                .prepend(
                    '<div id="ajodanie"><span><img src="./assets/images/92687.jpg"></span><span><img src="./assets/images/92687.jpg"></span><span><img src="./../assets/images/92714.jpg"></span><span><img src="./../assets/images/92714.jpg"></span></div>'
                );
    });

    $('.resizable[data-boxstyle="GameList"]').each(function () {
        if ($(this).find("#game_Wrapper").length == 0) {
            $(this).append(
                '<div id="game_Wrapper"><div><span class="prevSlideNews"  onClick="prevSlideNews(this)"></span><span class="nextSlideNews" onClick="nextSlideNews(this)"></span></div></div><div id="game_content"></div>'
            );
            $(this).find("#game_Wrapper div").append($(this).find(".blurbs"));
            $(this)
                .find(".blurbs .catblurb:first")
                .css("width", 0)
                .css("margin-left", 0);
        }
    });
}

function scroll_diamond(cls, index, text) {
    return (
        '<div id="scroll_diamond" class="' +
        cls +
        '" data-index="' +
        index +
        '"><svg class="blurp--top" width="192" height="61" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 160.7 61.5" enable-background="new 0 0 160.7 61.5" xml:space="preserve" style=""><path fill="#FFFFFF" d="M80.3,61.5c0,0,22.1-2.7,43.1-5.4s41-5.4,36.6-5.4c-21.7,0-34.1-12.7-44.9-25.4S95.3,0,80.3,0c-15,0-24.1,12.7-34.9,25.4S22.3,50.8,0.6,50.8c-4.3,0-6.5,0,3.5,1.3S36.2,56.1,80.3,61.5z"></path></svg><span class="scrollTitle">' +
        text +
        '</span><div class="inner_scroll_1"></div><div class="inner_scroll_2"></div><div class="inner_scroll_3"></div> </div>'
    );
}
function setServiceBoxHieght() {
    var wHeight = $(window).height() / 2;
    var wWidth = $(window).width() / 2.5;
    if (wHeight > wWidth)
        $(".heart-loader").css("width", wWidth).css("height", wWidth);
    else $(".heart-loader").css("width", wHeight).css("height", wHeight);

    if ($("body").attr("data-menuid") == -1 && $("#page_wrap").length == 0) {
        $("body").append('<div id="page_wrap"></div>');

        $('#wrapper-main-page[data-menuid="-1"] > .resizable').each(
            function () {
                $("#page_wrap").append(
                    '<span data-boxid="' +
                        $(this).attr("data-boxid") +
                        '"><label>' +
                        $(this).find(" > h4").html() +
                        "</label></span>"
                );
            }
        );
        $("#page_wrap > span:first").addClass("active");
        $("#page_wrap").append(
            '<span id="footer_page"><label>اطلاعات تماس</label></span>'
        );
        $("#page_wrap").append('<div id="next_page"></div>');
    }
    $('#wrapper-main-page[data-menuid="-1"] > .resizable').attr(
        "style",
        "height:" + $(window).height() + "px !important"
    );

    $(
        '.resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="slideshow"], .resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="content"]'
    ).removeAttr("style");
    if (!checkIsMobile()) {
        var tabServiceHieght = $(window).height() - 92;
        $(
            '#wrapper-main-page .resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="content"]'
        ).each(function () {
            $(this).find("> h4").prependTo($(this).find("> div"));
            $(this)
                .find('a[data-temp="PageContent"]')
                .attr("data-popupstyle", "true");
        });
        $(
            '.resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="slideshow"], .resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="content"]'
        ).attr("style", "height:" + tabServiceHieght + "px !important");
    }

    $("#footer").attr("style", "height:" + $(window).height() + "px");

    setTimeout(function () {
        if (checkIsMobile()) {
            $("#mainNavigation").attr(
                "style",
                "height:" + $(window).height() + "px !important"
            );
        }
    }, 500);
    var index = 0;
    if (pageFirstLoad) {
        pageFirstLoad = false;
        var bodyscrollTop = $("html").scrollTop();
        index = bodyscrollTop / $(window).height();
    }
    SetResizableAnimatation(index);

    $("#msScroll_wrapper")
        .stop()
        .animate(
            {
                opacity: "1",
            },
            1200,
            "easeInQuart",
            function () {
                $("body").addClass("loaded");
            }
        );
}

$("div#page_wrap > span").live("click", function () {
    SetResizableAnimatation($(this).index());
});
$("#next_page").live("click", function () {
    SetResizableAnimatation($("div#page_wrap > span.active").index() + 1);
});

$("html").on("keydown", function (event) {
    var Key = {
        LEFT: 37,
        UP: 38,
        RIGHT: 39,
        DOWN: 40,
    };
    var x = event.which || event.keyCode;
    if (Key.DOWN == x)
        SetResizableAnimatation($("div#page_wrap > span.active").index() + 1);
    else if (Key.UP == x)
        SetResizableAnimatation($("div#page_wrap > span.active").index() - 1);
});

var animating = false,
    animateSpeed = 800,
    animationName = "easeOutCubic";
function nextSlideNews(elem) {
    $this = $(elem);
    if (!animating) {
        animating = true;
        var selectorSlide = $this.parent().hasClass("wrapper_Col")
            ? "#newsWidget > div"
            : ".blurbs .catblurb";
        var $first = $this.parent().find(selectorSlide + ":first");
        $first.appendTo($first.parent()).removeAttr("style").addClass("moved");
        $first = $this.parent().find(selectorSlide + ":first");

        $first.stop().animate(
            {
                width: "0",
                marginLeft: "0",
            },
            animateSpeed,
            animationName,
            function () {
                animating = false;
            }
        );
    }
}
//$('.nextSlideNews').live('click', function () {

//})
function prevSlideNews(elem) {
    $this = $(elem);
    if (!animating) {
        animating = true;
        var selectorSlide = $this.parent().hasClass("wrapper_Col")
            ? "#newsWidget > div"
            : ".blurbs .catblurb";
        var $first = $this.parent().find(selectorSlide + ":first");
        var $last = $this.parent().find(selectorSlide + ":last");
        $last
            .prependTo($first.parent())
            .css("width", 0)
            .css("margin-left", 0)
            .addClass("moved");

        $first.stop().animate(
            {
                width: $this
                    .parent()
                    .find(selectorSlide + ":eq(2)")[0]
                    .getBoundingClientRect().width,
                marginLeft: $this
                    .parent()
                    .find(selectorSlide + ":eq(2)")
                    .css("margin-left"),
            },
            animateSpeed,
            animationName,
            function () {
                animating = false;
            }
        );
    }
}

$(".header-opener").click(function () {
    if ($("body").hasClass("head-active")) {
        $("body").removeClass("head-active");
    } else {
        $("body").addClass("head-active");
    }
});

//...........................vaghti jai gheir az menu va icone menu click mikonim, menu baste shavad...................
$(document).live("click", function (e) {
    var elem = $(e.target).closest(
        "#mainNavigation, .header-opener,#menuPageCover"
    );
    if (elem.length == 0) {
        $("body").removeClass("head-active");
    }
});

$("ul#mainNavigation a").click(function () {
    $("body").removeClass("head-active");
});

$('.resizable[data-boxstyle="Employees"] .blurbs .catblurb').live(
    "mouseenter",
    function () {
        $(
            '.resizable[data-boxstyle="Employees"] .blurbs .catblurb'
        ).removeClass("active");
        $(this).addClass("active");
    }
);

$('.resizable[data-boxstyle="timeLine"] .blurbs .catblurb h3').live(
    "mouseenter",
    function () {
        $('.resizable[data-boxstyle="timeLine"] .blurbs .catblurb').removeClass(
            "active"
        );
        $(this).parent().addClass("active");
    }
);

$(window).scroll(function () {
    var elTop = $(window).scrollTop();
    var scrollTop = elTop + $(window).height();

    $('.resizable[data-boxstyle="paralax"]').each(function () {
        if (scrollTop > $(this).offset().top)
            $(this).find("img").css("opacity", "1");
        else $(this).find("img").css("opacity", "0");
    });

    $("#galleryContent ul li").each(function () {
        if (elTop > $(this).offset().top - $(window).height() + 200) {
            $(this).addClass("animated");
        } else {
            //$(this).removeClass('animated')
        }
    });
});

$(".MovieGalleryAlbum .screenshot").live("click", function () {
    $(this).parent().hide();
    var $galleryContent = $(this).parent().parent().find("#galleryContent");
    if ($galleryContent.find(".backToMovieList").length == 0) {
        $galleryContent
            .prepend('<span class="backToMovieList"></span>')
            .find("iframe")
            .hide();
    }

    var movieIframe = $("#movieFrame" + $(this).attr("data-id"));
    if (
        movieIframe.attr("data-src") != null &&
        movieIframe.attr("data-src") != ""
    ) {
        movieIframe.attr("src", movieIframe.attr("data-src"));
    }
    movieIframe.show();
});

$(".backToMovieList").live("click", function () {
    $(this).parent().find("iframe").hide();
    $(this)
        .parent()
        .find("iframe")
        .each(function () {
            if ($(this).attr("src") != null && $(this).attr("src") != "") {
                $(this).attr("data-src", $(this).attr("src"));
                $(this).attr("src", "");
            }
        });
    $(this).parent().parent().find(".MovieGalleryAlbum").show();
    $(this).remove();
});

var animating = false,
    animateSpeed = 800,
    animationName = "easeOutCubic";
function nextSlideNews(elem) {
    $this = $(elem);
    if (!animating) {
        animating = true;
        var selectorSlide = $this.parent().hasClass("wrapper_Col")
            ? "#newsWidget > div"
            : " ul li";
        var $first = $this.parent().find(selectorSlide + ":first");
        $first.appendTo($first.parent()).removeAttr("style").addClass("moved");
        $first = $this.parent().find(selectorSlide + ":first");

        $first.stop().animate(
            {
                width: "0",
                marginLeft: "0",
            },
            animateSpeed,
            animationName,
            function () {
                animating = false;
            }
        );
    }
}
$('a[href="footer"]').live("click", function (e) {
    e.preventDefault();
    $("html")
        .stop()
        .animate(
            {
                scrollTop: $("footer").offset().top,
            },
            500,
            "swing",
            function () {}
        );
});
//$('.nextSlideNews').live('click', function () {

//})
function prevSlideNews(elem) {
    $this = $(elem);
    if (!animating) {
        animating = true;
        var selectorSlide = $this.parent().hasClass("wrapper_Col")
            ? "#newsWidget > div"
            : "ul li";
        var $first = $this.parent().find(selectorSlide + ":first");
        var $last = $this.parent().find(selectorSlide + ":last");
        $last
            .prependTo($first.parent())
            .css("width", 0)
            .css("margin-left", 0)
            .addClass("moved");

        $first.stop().animate(
            {
                width: $this
                    .parent()
                    .find(selectorSlide + ":eq(2)")[0]
                    .getBoundingClientRect().width,
                marginLeft: 0,
            },
            animateSpeed,
            animationName,
            function () {
                animating = false;
            }
        );
    }
}

$(
    '.resizable[data-boxstyle="slideGallery"] div#galleryContent ul li:eq(2)'
).live("click", function () {
    $(this).parent().parent().find(".prevSlideNews").click();
});
$(
    '.resizable[data-boxstyle="slideGallery"] div#galleryContent ul li:eq(4)'
).live("click", function () {
    $(this).parent().parent().find(".nextSlideNews").click();
});

$("#next_page").live("click", function () {
    SetResizableAnimatation($("div#page_wrap > span.active").index() + 1);
});
$("#scroll_diamond").live("click", function () {
    SetResizableAnimatation($(this).attr("data-index"));
});

var paginationTimeput;
$(
    '.resizable[data-boxstyle="tabServices"] .resizable[data-tmplname="slideshow"] > div'
)
    .live("mousemove", function () {
        $(".slidesjs-pagination").addClass("active");
        clearTimeout(paginationTimeput);
        paginationTimeput = setTimeout(function () {
            $(".slidesjs-pagination").removeClass("active");
        }, 2000);
    })
    .live("mouseleave", function () {
        $(".slidesjs-pagination").removeClass("active");
    });
