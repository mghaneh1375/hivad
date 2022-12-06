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
                    <h1>پیام ها</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12">
                            <table>
                                <thead>
                                    <th>ردیف</th>
                                    <th>نام ارسال کننده</th>
                                    <th>شماره تماس</th>
                                    <th>ایمیل</th>
                                    <th>عنوان</th>
				    <th>متن پیام</th>
                                    <th>زمان ارسال</th>

                                    <th>عملیات</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($msgs as $itr)
                                        <tr id="item_{{ $itr->id }}">
                                            <td>{{ $i }}</td>
                                            <td>{{ $itr->name }}</td>
                                            <td>{{ $itr->phone }}</td>
                                            <td>{{ $itr->mail }}</td>
                                            <td>{{ $itr->title }}</td>
					    <td>{{ $itr->msg }}</td>
                                            <td>{{ $itr->created_at }}</td>
                                            <td>
                                                <button onclick="remmoveModal('item', {{$itr->id}}, '{{ route('api.removeMsg', ['msg' => $itr->id]) }}')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
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
    </div>

    <div class="col-md-1"></div>

   
    <div id="msgModal" class="modal hidden">
        <div class="modal-content" style="width: 70%;">
            <div id="msg"></div>
            <div class="flex center gap10">
                <input type="button" value="بازگشت" class="btn green"  style="margin-bottom: 3%; margin-left: 5px;" onclick="$('#msgModal').addClass('hidden')">
            </div>
        </div>
    </div>

    <script>

        function showMsg(msg) {
            $("#msg").empty().append(msg);
            $("#msgModal").removeClass('hidden');
        }

    </script>

@stop
