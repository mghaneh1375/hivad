@extends('layouts.structure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{asset('css/createStyle.css')}}" />
@stop

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    <h1>افزودن متخصص</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" style="border: solid;">
                            
                            <div style="margin-top: 10px;">
                                
                                @if(isset($people))
                                    <img src="{{URL::asset('Content/images/shortcutTab/' . $people->image)}}" alt="{{ $people->alt }}" style="width:100px; height: 100px">
                                @endif

                                <form id="myForm" action="{{isset($people) ? route('api.updatePeople', ['people' => $people]) : route('api.addPeople')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        
                                        <div>
                                            <label for="name">نام و نام خانوادگی</label>
                                            <input value="{{ isset($people) ? $people->name : '' }}" type="text" name="name" id="name"/>
                                        </div>

                                        <div>
                                            <label for="imgInp">فایل تصویر</label>
                                            <input type="file" name="image" {{ isset($people) ? '' : 'required' }} id="imgInp">
                                        </div>    

                                        <div>
                                            <label for="priority">اولویت</label>
                                            <input value="{{ isset($people) ? $people->priority : '' }}" type="number" required name="priority" id="priority" />
                                        </div>
                                        <div>
                                            <label for="alt">تگ alt</label>
                                            <input value="{{ isset($people) ? $people->alt : '' }}" type="text" placeholder="این فیلد اختیاری است" name="alt" id="alt" />
                                        </div>
                                            
                                        
                                        <div>
                                            <label for="visibility">وضعیت نمایش؟</label>
                                            <select name="visibility" id="visibility">
                                                <option {{ isset($people) && !$people->visibility ? 'selected' : '' }} value="0">خیر</option>
                                                <option {{ isset($people) && $people->visibility ? 'selected' : '' }} value="1">بله</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="bio">بیو</label>
                                            <textarea name="bio" placeholder="بیو">{{ isset($people) ? $people->bio : '' }}</textarea>
                                        </div>
                                        
                                    </div>
                        

                                    <div class="flex center gap10">
                                        <span onclick="document.location.href = '{{ route('managePeople') }}'" class="btn btn-danger">بازگشت</span>
                                        <input type="submit" value="ذخیره" class="btn green">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>
    
@stop