@extends('layouts.structure')

@section('header')

    <style>
        * {
            box-sizing: border-box;
        }

        .column {
            float: left;
            width: 33.33%;
            padding: 5px;
            height: 300px;
            max-height: 300px;

        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #008CBA;
            overflow: hidden;
            width: 100%;
            height: 100%;
            -webkit-transform: scale(0);
            -ms-transform: scale(0);
            transform: scale(0);
            -webkit-transition: .3s ease;
            transition: .3s ease;
        }

        .myContainer:hover .overlay {
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container {
            position: relative;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 30%;
            direction: rtl;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }
        .cke_chrome {
            margin-top: 20px;
            border: none !important;
        }
    </style>

    @parent
@stop

@section('content')

    <div class="col-md-2"></div>

    <div class="col-md-8">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    <h1>مدیریت اسلایدبار</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        @for($i = 0; $i < count($slide); $i++)
                            <div class="column col-xs-4 myContainer">
                                <img src="{{URL::asset('slidebar/'.$slide[$i]->pic)}}" alt="Snow" style="width:100%; height: 100%">
                                <div class="overlay">
{{--                                    <input class="text" value="" id="editurl{{$slide[$i]->id}}" style="display: none; color: black" onchange="editUrl({{$slide[$i]->id}})">--}}
                                    <center>
                                        <input type="submit" value="حذف" class="btn green" onclick="deleteSlideQuest({{$slide[$i]->id}})" style="margin-top: 130px; color: white; background-color: rebeccapurple">
                                    </center>
                                </div>
                            </div>
                        @endfor

                        <div class="column" style="border: solid;">
                            <div>
                                <center>
                                    <img id="blah" src="{{URL::asset('img/12.svg')}}"  alt="your image" style="width:100%; height: 165px;">
                                </center>
                            </div>
                            <div style="margin-top: 5%;">
                                <form id="add_slide_show" action="{{route('saveSlideShow')}}" method="post"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="kind" value="save">
                                    <input type="file" name="pic" id="imgInp">

                                    <center>
                                        <input type="submit" value="ذخیره" class="btn green">
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2"></div>

    <div id="myModal" class="modal">
        <form action="{{route('saveSlideShow')}}" method="post">
            {{ csrf_field() }}
            <div class="modal-content">
                <input type="hidden" value="" id="slideId" name="id">
                <input type="hidden" value="delete" name="kind">
                <h2 style="padding-right: 5%;">ایا اطیمنان دارید؟</h2>
                <center>
                    <input type="submit" value="بله" class="btn green"  style="margin-right: 5px; margin-bottom: 3%">
                    <input type="button" value="انصراف" class="btn green"  style="margin-bottom: 3%; margin-left: 5px;" onclick="document.getElementById('myModal').style.display = 'none'">
                </center>
            </div>
        </form>
    </div>

    <script>
        var modal = document.getElementById('myModal');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        $.ajaxSetup(
            {
                headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
            });
    </script>

    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>

    <script>
        function editUrl(id) {
            if(document.getElementById('url'+id).style.display == 'inline-block'){
                document.getElementById('url'+id).style.display = 'none';
                document.getElementById('editurl'+id).style.display = 'inline-block';
                document.getElementById('editurl'+id).value = document.getElementById('url'+id).innerText;
            }
            else{
                var url = document.getElementById('editurl'+id).value;
                if(url !== '') {
                    $.ajax({
                        type: 'post',
                        url: '{{url("saveSlideShow")}}',
                        data:{
                            'id': id,
                            'url': url,
                            'kind': 'edit'
                        },
                        success: function (response) {
                            if (response === 'ok') {
                                document.getElementById('editurl' + id).style.display = 'none';
                                document.getElementById('url' + id).innerText = url;
                                document.getElementById('url' + id).style.display = 'inline-block';
                            }
                        }
                    });
                }
            }
        }

        function deleteSlideQuest(id) {
            document.getElementById('myModal').style.display = 'block';
            document.getElementById('slideId').value = id;
        }
    </script>
@stop