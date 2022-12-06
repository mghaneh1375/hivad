@extends('layouts.structure')

@section('header')
    @parent
    <link rel="stylesheet" href="{{asset('css/createStyle.css')}}" />
    <style>
        #allOptions {
            width: 100%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            border-top: 2px solid;
            padding: 10px;
        }
        #allOptions > div {
            padding: 10px;
            border: 1px solid;
            border-radius: 7px;
            margin-left: 10px;
            margin-right: 10px;
        }

        #allOptions > div > li {
            cursor: pointer;
            margin-left: 4px;
            margin-right: 4px;
        }
    </style>
@stop

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    <h1>{{ isset($field) ? 'ویرایش فیلد' : 'افزودن فیلد جدید' }}</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" style="padding: 0">
                            
                            <div style="margin-top: 10px;">
                                <form id="myForm" action="{{ isset($field) ? route('api.' . $mode . '.question.update', ['field' => $field['id']]) : route('api.' . $mode . '.question.store')}}" method="post">
                                    @csrf

                                    <div class="flex flex-col center gap10" style="margin: 10px">
                                        
                                        <div>
                                            <label for="is_required">آیا پاسخ به این فیلد ضروری است</label>
                                            <select name="is_required" id="is_required">
                                                <option {{ isset($field) && $field['is_required'] ? 'selected' : '' }} value="1">بله</option>
                                                <option {{ isset($field) && !$field['is_required'] ? 'selected' : '' }} value="0">خیر</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label for="visibility">وضعیت نمایش</label>
                                            <select name="visibility" id="visibility">
                                                <option {{ isset($field) && $field['visibility'] ? 'selected' : '' }} value="1">بله</option>
                                                <option {{ isset($field) && !$field['visibility'] ? 'selected' : '' }} value="0">خیر</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="priority">اولویت</label>
                                            <input value="{{ isset($field) ? $field['priority'] : '' }}" type="number" required name="priority" id="priority" />
                                        </div>

                                        <div>
                                            <label for="type">نوع سوال</label>
                                            <select onchange="changeType(this.value)" name="type" id="type">
                                                <option {{ isset($field) && $field['type'] == 'text' ? 'selected' : '' }} value="text">متنی</option>
                                                <option {{ isset($field) && $field['type'] == 'textarea' ? 'selected' : '' }} value="textarea">متن بلند</option>
                                                <option {{ isset($field) && $field['type'] == 'number' ? 'selected' : '' }} value="number">عدد</option>
                                                <option {{ isset($field) && $field['type'] == 'radio' ? 'selected' : '' }} value="radio">انتخاب یک گزینه از بین سایرین</option>
                                            </select>
                                        </div>

                                        <div id="optionsContainer" class="hidden">
                                            <label>گزینه های مدنظر</label>
                                            <input id="option" type="text" onkeypress="checkEnter(event)" />
                                        </div>

                                        
                                        <div id="allOptions" class="hidden"></div>
                                        
                                        <div>
                                            <label for="slug">نامک</label>
                                            <input value="{{ isset($field) ? $field['slug'] : '' }}" type="text" name="slug" id="slug"/>
                                        </div>
                                            
                                        <div>
                                            <label for="label">لیبل</label>
                                            <input value="{{ isset($field) ? $field['label'] : '' }}" type="text" name="label" id="label"/>
                                        </div>
                                        
                                    </div>
                        

                                    <div class="flex center gap10">
                                        <span onclick="document.location.href = '{{ route($mode . '.questions.list') }}'" class="btn btn-danger">بازگشت</span>
                                        <span class="btn green" id="saveBtn">ذخیره</span>
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

    <script>

        let options = [];

        @if(isset($field) && ($field['type'] == 'radio' || $field['type'] == 'checkbox') && $field['options'] !== null)
            @foreach ($field['options'] as $itr)
                options.push('{{ $itr }}');
            @endforeach
            
            $("#optionsContainer").removeClass('hidden');
            $("#allOptions").removeClass('hidden');
            $("#myForm").append("<input type='hidden' name='options' id='options' />")
            renderOptions();
        @endif

        function changeType(val) {

            if(val == "radio" || val == "checkbox") {
                $("#optionsContainer").removeClass('hidden');
                $("#allOptions").removeClass('hidden');
                $("#myForm").append("<input type='hidden' name='options' id='options' />")
            }
            else {
                $('#options').remove();
                $("#allOptions").addClass('hidden');
                $("#optionsContainer").addClass('hidden');
            }

        }

        function renderOptions() {

            let i = 0;
            let html = "";
            options.forEach(option => {
                html += "<div><span>" + option + "</span><li id='remove_option_" + i + "' data-id='" + i + "' class='remove-option-btn glyphicon glyphicon-trash'></li></div>";
                i++;
            });

            $("#allOptions").empty().append(html);
        }

        function checkEnter(e) {
            
            if(e.keyCode !== 13)
                return;
            
            let val = $("#option").val();
            
            if(val.length === 0)
                return;

            options.push(val);
            $("#option").val("");
            renderOptions();
        }

        $(document).ready(function() {
            $("#saveBtn").on('click', function() {
                
                let type = $("#type").val();

                if(type === "checkbox" || type === "radio") {
                    $("#options").val(options);
                }

                $("#myForm").submit();
            });
        });

        $(document).on('click', '.remove-option-btn', function() {
            
            let idx = $(this).attr('data-id');
            options.splice(idx, 1);
            renderOptions();

        });

    </script>

@stop