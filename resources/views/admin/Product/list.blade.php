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
                    <h1>مدیریت محصولات</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">
                        
                        <div class="flex center">
                            <button onclick="window.location.href = '{{ route('addProduct') }}'" class="btn btn-success">افزودن مورد جدید</button>
                        </div>

                        <div class="col-xs-12">

                            <table id="table" data-toggle="table" data-search="true" data-show-columns="true"
                                data-key-events="true" data-show-toggle="true" data-resizable="true" data-show-export="true"
                                data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>وضعیت</th>
                                    <th>تعداد خریداران</th>
                                    <th>تصویر</th>
                                    <th>فایل محصول</th>
                                    <th>نمایش در صفحه نخست</th>
                                    <th>متن خلاصه</th>
                                    <th>عملیات</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($allProducts as $product)
                                        <tr id="item_{{ $product['id'] }}">
                                            <td>{{ $i }}</td>
                                            <td>{{ $product['title'] }}</td>
                                            <td>{{ $product['visibility'] ? 'فعال' : 'غیرفعال' }}</td>
                                            <td>{{ $product['buyers'] }}</td>
                                            <td><img src="{{$product['img']}}" style="height:50px;"></td>
                                            <td><a href="{{ $product['file'] }}" download="true" target="_blank">دانلود</a></td>
                                            <td>{{ $product['is_imp'] ? 'بله' : 'خیر' }}</td>
                                            <td>{{ $product['digest'] }}</td>
                                            <td>
                                                <button class="btn btn-primary" onclick="document.location.href = '{{ route('editProduct', ['product' => $product['id']]) }}'">ویرایش</button>
                                                <button class="btn btn-danger" onclick="remmoveModal('item', {{$product['id']}}, '{{ route('api.removeProduct', ['product' => $product['id']]) }}')">حذف</button>
                                            </td>
                                        </tr>

                                        <?php $i++; ?>
                                    @endforeach

                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>
@stop