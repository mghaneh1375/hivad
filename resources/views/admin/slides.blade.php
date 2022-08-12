@extends('layouts.structure')

@section('header')
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