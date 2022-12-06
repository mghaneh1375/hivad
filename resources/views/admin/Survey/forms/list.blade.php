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
                    @if($mode == 'survey')
                        <h1>مدیریت فرم های نظرسنجی</h1>
                    @else
                        <h1>مدیریت فرم های درخواست مشاوره</h1>
                    @endif
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
                                    <td>عملیات</td>
                                </tr>
                                @foreach($forms as $form)
                                    <tr id="item_{{ $form['id'] }}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $form['created_at'] }}</td>
                                        <td>{{ $form['seen'] ? 'دیده شده' : 'دیده نشده' }}</td>
                                        <td>
                                            
                                            <button onclick="document.location.href = '{{ route($mode . '.forms.show', ['form' => $form['id']]) }}'" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </button>

                                            <button onclick="remmoveModal('item', {{$form['id']}}, '{{ route('api.' . $mode . '.forms.destroy', ['form' => $form['id']]) }}')" class="btn btn-danger">
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
@stop