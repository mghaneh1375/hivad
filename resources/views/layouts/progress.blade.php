
    <div id="ah7progress">
        <div id='ah7bar'></div>
        <div id='ah7percent'></div>
        <div class="circles" id="ah7CircleLodding">
            <div class="circles-wrp" style="position: relative; display: inline-block;">
                <svg>
                    <circle id="ah7CircleShap" cx="100" cy="100" r="95" stroke-dasharray="610" stroke-dashoffset="610"></circle>
                </svg><div class="circles-text">0%</div>
            </div>
        </div>
    </div>
    <div id="dialogAh7Box">
        <div class="pageCover"></div>
        <div id="dialogAh7Box-wrapper">
            <div style="text-align: right;"><span id="close-dialogAh7Box" title="بستن صفحه"> </span></div>
            <section id="dialogContent"></section>
        </div>
    </div>
    <div id="fMainContent"></div>
    <div id="loading-img">
        <div class="">
            <span class="span_loaddingImg"></span>
            <div>
                <span id="loadding-image">
                    <span></span>
                </span>
            </div>
        </div>
    </div>

    <script>
        
        var preLoaddingCounter = 0, currentpreLoaddingWidth = 0;
        function check_element(e, n) {
            if ("IMG" == e.tagName) { var t = new Image; t.src = e.src; try { t.onerror = function () { preLoaddingFn(n) }, t.onabort = function () { preLoaddingFn(n) }, t.onload = function () { preLoaddingFn(n) } } catch (e) { preLoaddingFn(n) } }
        }
        function preLoaddingFn(e, n) {
            currentpreLoaddingWidth = 100 / e + Number(currentpreLoaddingWidth)
        }
        document.onreadystatechange = function (e) {
            if ("interactive" == document.readyState)
            {
                var maxstOffset = 610;
                    t = document.getElementsByTagName("img"),
                    r = setInterval(function () {
                        if (preLoaddingCounter < currentpreLoaddingWidth && (preLoaddingCounter++ ,
                            document.getElementById("ah7bar").style.width = preLoaddingCounter + "%",
                            document.getElementById("ah7percent").innerHTML = preLoaddingCounter + "%",
                            document.getElementById('ah7CircleShap').setAttribute('stroke-dashoffset', maxstOffset - (maxstOffset * preLoaddingCounter / 100)),
                            document.getElementsByClassName('circles-text')[0].innerHTML = preLoaddingCounter + "%",
                           // n.update(preLoaddingCounter, 200),
                            100 == preLoaddingCounter)
                        )
                        { document.body.classList.add("progressComplete"), clearInterval(r); try { window.AfterProgressComplete() } catch (e) { } }
                    }, 5);
                if (0 == t.length) currentpreLoaddingWidth = 100; else for (var d = 0, o = t.length; d < o; d++)check_element(t[d], t.length)
            } if ("complete" == document.readyState)
            {
                document.body.classList.add("progressComplete");
                try { window.AfterProgressComplete() } catch (e) { }
            }
        };
    </script>