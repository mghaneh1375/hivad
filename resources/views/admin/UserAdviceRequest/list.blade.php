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
                    <h1>مدیریت درخواست های وقت مشاوره</h1>
                </div>
            </div>

            <div class="sparkline8-graph dashone-comment messages-scrollbar dashtwo-messages">

                <div id="mainContainer" class="page-content" style="margin-top: 5%; margin: 50px; direction: rtl">

                    <div class="row">

                        <div class="col-xs-12">
                            <?php $i = 1; ?>
                            <table>
                                <tr>
                                    <td>ردیف</td>
                                    <td>زمان ثبت</td>
                                    <td>وضعیت رویت</td>
                                    <td>نام</td>
                                    <td>شماره همراه</td>
                                    <td>زمان موردنظر</td>
                                    <td>تاریخ موردنظر</td>
                                    <td>متخصص</td>
                                    <td>تخصص</td>
                                    <td>توضیحات تکمیلی</td>
                                    <td>وضعیت</td>
                                    <td>عملیات</td>
                                </tr>
                                @foreach($forms as $form)
                                    <tr id="item_{{ $form['id'] }}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $form['created_at'] }}</td>
                                        <td>{{ $form['seen'] ? 'دیده شده' : 'دیده نشده' }}</td>
                                        <td>{{ $form['name'] }}</td>
                                        <td>{{ $form['phone'] }}</td>
                                        <td>{{ $form['start'] . ' تا ' . $form['end']}}</td>
                                        <td>{{ $form['date'] }}</td>
                                        <td>{{ $form['people'] }}</td>
                                        <td>{{ $form['tag'] }}</td>
                                        <td>{{ $form['description'] }}</td>
                                        <td id="status_{{ $form['id'] }}">{{ $form['status'] }}</td>
                                        <td>
                                            
                                            <button data-id='{{ $form['id'] }}'  class="updateBtn btn btn-primary">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </button>

                                            <button onclick="remmoveModal('item', {{$form['id']}}, '{{ route('api.user_advice_requests', ['user_advice_request' => $form['id']]) }}')" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
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

    
    <div id="myModal" class="modal hidden">
        <div class="modal-content" style="width: 70%;">
            
            <div>
                <label for="status">وضعیت موردنظر</label>
                <select id="status">
                    <option value="pending">در حال بررسی</option>
                    <option value="accepted">تایید درخواست</option>
                    <option value="rejected">رد درخواست</option>
                </select>
            </div>

            <div class="flex center gap10">
                <input type="button" value="تایید" class="btn green"  style="margin-bottom: 3%; margin-left: 5px;" onclick="update()">
                <input type="button" value="بازگشت" class="btn green"  style="margin-bottom: 3%; margin-left: 5px;" onclick="$('#myModal').addClass('hidden')">
            </div>

        </div>
    </div>

    <script>

        let selectedId;

        $(document).ready(function() {
            $(".updateBtn").on('click', function() {
                selectedId = $(this).attr('data-id');
                $('#myModal').removeClass('hidden');
            });
        });

        function update() {
            
            var newStatus = $("#status").val();

            $.ajax({
                type: 'post',
                url: '{{ route('api.user_advice_requests.update') }}',
                data: {
                    status: newStatus,
                    user_advice_request_id: selectedId
                },
                success: function(res) {
                    
                    if(res.status === 'ok') {
                        if(newStatus === 'pending')
                            $("#status_" + selectedId).empty().append('در حال بررسی');
                        else if(newStatus === 'accepted')
                            $("#status_" + selectedId).empty().append('تایید شده');
                        else if(newStatus === 'rejected')
                            $("#status_" + selectedId).empty().append('رد شده');

                        $('#myModal').addClass('hidden');
                    }

                }
            });
        }

    </script>

@stop