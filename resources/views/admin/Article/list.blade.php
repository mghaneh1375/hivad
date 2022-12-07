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
                    <h1>مدیریت مقالات</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">
                        
                        <div class="flex center">
                            <button onclick="window.location.href = '{{ route('articles.create') }}'" class="btn btn-success">افزودن مورد جدید</button>
                        </div>

                        <div class="col-xs-12">
                            <?php $i = 1 ?>
                            <table>
                                <tr>
                                    <td>ردیف</td>
                                    <td>عنوان</td>
                                    <td>وضعیت نمایش</td>
                                    <td>اولویت</td>
                                    <td>تعداد بازدید</td>
                                    <td>تعداد دانلود</td>
                                    <td>عملیات</td>
                                </tr>
                                @foreach($articles as $article)
                                    <tr id="item_{{ $article['id'] }}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $article['title'] }}</td>
                                        <td>{{ $article['visibility'] ? 'فعال' : 'غیرفعال' }}</td>
                                        <td>{{ $article['priority'] }}</td>
                                        <td>{{ $article['seen'] }}</td>
                                        <td>{{ $article['download'] }}</td>
                                        <td>
                                            <button class="btn btn-primary" onclick="document.location.href = '{{ route('articles.edit', ['article' => $article['id']]) }}'">ویرایش</button>
                                            <button class="btn btn-danger" onclick="remmoveModal('item', {{$article['id']}}, '{{ route('api.article.destory', ['article' => $article['id']]) }}')">حذف</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>
@stop