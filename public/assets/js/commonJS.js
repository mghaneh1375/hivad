setTimeout(function () {
    document.addEventListener("DOMContentLoaded", function (event) {
        document.querySelectorAll("img").forEach(function (img) {
            img.onerror = function () {
                this.style.display = "none";
            };
        });
    });
}, 3000);

var ie = (function () {
    var undef,
        v = 3,
        div = document.createElement("div"),
        all = div.getElementsByTagName("i");
    while (
        ((div.innerHTML = "<!--[if gt IE " + ++v + "]><i></i><![endif]-->"),
        all[0])
    );
    return v > 4 ? v : undef;
})();
if (ie != null && ie < 9) {
    document.body.removeChild(document.getElementsByTagName("script")[0]);
    document.getElementById("loading-img").outerHTML = "";
    document.getElementById("wrapper-main-page").outerHTML =
        '<div style="text-align: center;margin: 30px auto; font-size: 20px;width: 630px;direction: rtl;"><div>We dont support this version of your browser</div><img src="/Content/img/browserSupport.png"></div>';
}
