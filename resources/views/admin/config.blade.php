@extends('layouts.structure')

@section('header')
    @parent
@stop


@section('content')

    <div class="col-md-1"></div>
    
    <div class="col-md-10">
        <div class="sparkline8-list shadow-reset mg-tb-30">
            <div class="sparkline8-hd">
                <div class="main-sparkline8-hd">
                    <h1>مدیریت صفحه نخست</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12" id="itemsContainer">

                            <div class="flex flex-col center gap10">
                            
                                <div>
                                    <label for="showAbout">نمایش درباره ما</label>
                                    <select id="showAbout">
                                        @if($config->show_about == 1)
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @else
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="showVideos">نمایش ویدیوها</label>
                                    <select id="showVideos">
                                        @if($config->show_videos)
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @else
                                            <option value="false">مخفی</option>
                                            <option value="true">نمایش</option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="showGallery">نمایش گالری</label>
                                    <select id="showGallery">
                                        @if($config->show_gallery)
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @else
                                            <option value="false">مخفی</option>
                                            <option value="true">نمایش</option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="showArticle">نمایش مقالات</label>
                                    <select id="showArticle">
                                        @if($config->show_article)
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @else
                                            <option value="false">مخفی</option>
                                            <option value="true">نمایش</option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="showNews">نمایش اخبار</label>
                                    <select id="showNews">
                                        @if($config->show_news)
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @else
                                            <option value="false">مخفی</option>
                                            <option value="true">نمایش</option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="showProducts">نمایش محصولات</label>
                                    <select id="showProducts">
                                        @if($config->show_products)
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @else
                                            <option value="false">مخفی</option>
                                            <option value="true">نمایش</option>
                                        @endif
                                    </select>
                                </div>

                                <div>
                                    <label for="showInsta">نمایش پست های اینستاگرام</label>
                                    <select id="showInsta">
                                        @if($config->show_insta)
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @else
                                            <option value="false">مخفی</option>
                                            <option value="true">نمایش</option>
                                        @endif
                                    </select>
                                </div>

                                
                                <div>
                                    <label for="online_booking">امکان وقت گیری</label>
                                    <select id="online_booking">
                                        @if($config->online_booking)
                                            <option value="true">بله</option>
                                            <option value="false">خیر</option>
                                        @else
                                            <option value="false">خیر</option>
                                            <option value="true">بله</option>
                                        @endif
                                    </select>
                                </div>

                                <div>
                                    <label for="showSurvey">امکان نظرسنجی</label>
                                    <select id="showSurvey">
                                        @if($config->show_survey)
                                            <option value="true">نمایش</option>
                                            <option value="false">مخفی</option>
                                        @else
                                            <option value="false">مخفی</option>
                                            <option value="true">نمایش</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="flex center">
                                    <button onclick="save()" class="btn btn-sucess">ذخیره</button>
                                </div>

                            </div>

                        </div>
                
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-1"></div>

    <script>

        function save() {

            $.ajax({
                type: 'post',
                url: '{{ route('api.updateConfig') }}',
                data: {
                    'show_insta': $("#showInsta").val() == 'true' ? 1 : 0,
                    'show_article': $("#showArticle").val() == 'true' ? 1 : 0,
                    'show_news': $("#showNews").val() == 'true' ? 1 : 0,
                    'show_gallery': $("#showGallery").val() == 'true' ? 1 : 0,
                    'show_videos': $("#showVideos").val() == 'true' ? 1 : 0,
                    'show_about': $("#showAbout").val() == 'true' ? 1 : 0,
                    'show_survey': $("#showSurvey").val() == 'true' ? 1 : 0,
                    'show_products': $("#showProducts").val() == 'true' ? 1 : 0,
                    'online_booking': $("#online_booking").val() == 'true' ? 1 : 0,
                },
                headers: {
                    "accept": "application/json"
                },
                success: function(res) {
                    if(res.status === "ok") {
                        showSuccess("عملیات با موفقیت انجام شد.");
                    }
                }
            });

        }

    </script>
@stop