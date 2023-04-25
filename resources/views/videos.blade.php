@extends('layouts.siteLayout')

@section('header')
    @parent
    
    <style>
        
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

@stop

@section('menuId')'29408'@stop
@section('prefix')'videos-'@stop
@section('menuName')'گالری-فیلم'@stop
@section('title')گالری فیلم@stop


@section('customModal')
    <div id="playModal" class="modal hidden">
        <div class="modal-content">
            <video id="myCurrentVideo" width="100%" controls>
                
                Your browser does not support the video tag.
              </video> 
            <div class="flex center gap10">
                <input type="button" value="بازگشت" class="btn green"  style="margin-left: 5px;" onclick="$('#playModal').addClass('hidden')">
            </div>
        </div>
    </div>
@stop


@section('customJS')

    <script>
        $(document).ready(function() {
            $(document).on("click", ".videoImg", function(){
                var src = $(this).attr('src');
                var base = '{{ asset('storage/videos') }}';
                var videoFile = base + src.split(".")[0].split("/crop")[1] + ".mp4";
                $("#myCurrentVideo").attr('src', videoFile);
                $("#playModal").removeClass('hidden');
            });

        })
    </script>

@stop